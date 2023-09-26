<?php
/**
 * 协程并发站点服务项目
 *
 * @author https://github.com/JaydenOK
 */

namespace module\server;

use EasySwoole\ORM\Db\Config;
use EasySwoole\ORM\Db\Connection;
use EasySwoole\ORM\Db\MysqliClient;
use EasySwoole\ORM\DbManager;
use EasySwoole\Pool\Exception\PoolEmpty;
use EasySwoole\Pool\Manager;
use EasySwoole\Redis\Config\RedisConfig;
use Exception;
use InvalidArgumentException;
use module\lib\Dispatcher;
use module\lib\RedisPool;
use Swoole\Coroutine;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Process;
use Swoole\Server;
use Swoole\Table;
use Swoole\Timer;

class HttpServerManager
{

    const EVENT_START = 'start';
    const EVENT_MANAGER_START = 'managerStart';
    const EVENT_WORKER_START = 'workerStart';
    const EVENT_WORKER_STOP = 'workerStop';
    const EVENT_REQUEST = 'request';

    /**
     * @var \Swoole\Http\Server
     */
    protected $httpServer;
    /**
     * @var string
     */
    private $taskType;
    /**
     * @var int|string
     */
    private $port;
    private $processPrefix = 'co-web-';
    private $setting = [
        'enable_coroutine' => true,
        'worker_num' => 5,
        //一个 worker 进程在处理完超过此数值的任务后将自动退出，进程退出后会释放所有内存和资源
        'max_request' => 1000000,
        //最大连接数，适当设置，提高并发数，max_connection 最大不得超过操作系统 ulimit -n 的值(增加服务器文件描述符的最大值)，否则会报一条警告信息，并重置为 ulimit -n 的值
        //修改保存: vim /etc/security/limits.conf:
        // * soft nofile 10000
        // * hard nofile 10000
        'max_conn' => 10000,
        //设置Worker进程收到停止服务通知后最大等待时间【默认值：3】，需大于定时器周期时间，否则通知会报Warning异常
        'max_wait_time' => 20,
    ];
    /**
     * @var bool
     */
    private $daemon;
    /**
     * @var string
     */
    private $pidFile;
    private $checkAvailableTime = 1;
    private $checkLiveTime = 10;
    private $availableTimerId;
    private $liveTimerId;
    /**
     * @var Table
     */
    private $poolTable;
    /**
     * @var string
     */
    private $mainMysql = 'mainMysql';
    /**
     * @var string
     */
    private $mainRedis = 'mainRedis';
    /**
     * worker连接池最大连接数，闲置后回收
     * @var int
     */
    private $maxObjectNum = 100;
    /**
     * worker连接池初始化最小连接数
     * @var int
     */
    private $minObjectNum = 10;

    public function run($argv)
    {
        try {
            $cmd = isset($argv[1]) ? (string)$argv[1] : 'status';
            $this->port = isset($argv[2]) ? (int)$argv[2] : 8080;
            $this->daemon = isset($argv[3]) && (in_array($argv[3], ['daemon', 'd', '-d'])) ? true : false;
            if (empty($this->port) || empty($cmd)) {
                throw new InvalidArgumentException('params error');
            }
            $this->pidFile = $this->port . '.pid';
            switch ($cmd) {
                case 'start':
                    $this->start();
                    break;
                case 'stop':
                    $this->stop();
                    break;
                case 'status':
                    $this->status();
                    break;
                default:
                    break;
            }
        } catch (Exception $e) {
            $this->logMessage($e->getMessage());
        }
    }

    private function start()
    {
        //一键协程化，使回调事件函数的mysql连接、查询协程化
        Coroutine::set(['hook_flags' => SWOOLE_HOOK_TCP]);
        //\Swoole\Runtime::enableCoroutine(SWOOLE_HOOK_ALL);
        $this->renameProcessName($this->processPrefix . $this->taskType);
        $this->httpServer = new \Swoole\Http\Server("0.0.0.0", $this->port);
        $setting = [
            'daemonize' => (bool)$this->daemon,
            'log_file' => MODULE_DIR . '/logs/server-' . date('Y-m') . '.log',
            'pid_file' => MODULE_DIR . '/logs/' . $this->pidFile,
        ];
        $this->setServerSetting($setting);
        $this->createTable();
        $this->bindEvent(self::EVENT_START, [$this, 'onStart']);
        $this->bindEvent(self::EVENT_MANAGER_START, [$this, 'onManagerStart']);
        $this->bindEvent(self::EVENT_WORKER_START, [$this, 'onWorkerStart']);
        $this->bindEvent(self::EVENT_WORKER_STOP, [$this, 'onWorkerStop']);
        $this->bindEvent(self::EVENT_REQUEST, [$this, 'onRequest']);
        $this->startServer();
    }

    /**
     * 当前进程重命名
     * @param $processName
     * @return bool|mixed
     */
    private function renameProcessName($processName)
    {
        if (function_exists('cli_set_process_title')) {
            return cli_set_process_title($processName);
        } else if (function_exists('swoole_set_process_name')) {
            return swoole_set_process_name($processName);
        }
        return false;
    }

    private function setServerSetting($setting = [])
    {
        $this->httpServer->set(array_merge($this->setting, $setting));
    }

    private function bindEvent($event, callable $callback)
    {
        $this->httpServer->on($event, $callback);
    }

    private function startServer()
    {
        $this->httpServer->start();
    }

    public function onStart(Server $server)
    {
        $this->logMessage('start, master_pid:' . $server->master_pid);
        $this->renameProcessName($this->processPrefix . $this->port . '-master');
    }

    public function onManagerStart(Server $server)
    {
        $this->logMessage('manager start, manager_pid:' . $server->manager_pid);
        $this->renameProcessName($this->processPrefix . $this->port . '-manager');
    }

    //连接池，每个worker进程隔离
    public function onWorkerStart(Server $server, int $workerId)
    {
        $this->logMessage('worker start, worker_pid:' . $server->worker_pid);
        $this->renameProcessName($this->processPrefix . $this->port . '-worker-' . $workerId);
        //初始化连接池
        try {
            $dbConfig = $this->databaseConfig();
            //================= 注册 mysql 连接池 =================
            $config = new Config();
            $config->setHost($dbConfig['host'])
                ->setPort(3306)
                ->setUser($dbConfig['user'])
                ->setPassword($dbConfig['password'])
                ->setTimeout(30)
                ->setCharset($dbConfig['charset'])
                ->setDatabase($dbConfig['dbname'])
                ->setMaxObjectNum($this->maxObjectNum)  //连接池最大数，任务并发数不应超过此值
                ->setMinObjectNum($this->minObjectNum);
            DbManager::getInstance()->addConnection(new Connection($config), $this->mainMysql);    //连接池1
            $connection = DbManager::getInstance()->getConnection($this->mainMysql);
            $connection->__getClientPool()->keepMin();   //预热连接池1

            //=================  (可选) 注册redis连接池 (http://192.168.92.208:9511/Account/mysqlPoolList)  =================
            if (true) {
                $rsConfig = $this->redisConfig();
                $config = new \EasySwoole\Pool\Config();
                $redisConfig = new RedisConfig();
                $redisConfig->setHost($rsConfig['host']);
                $redisConfig->setPort($rsConfig['port']);
                $redisConfig->setAuth($rsConfig['auth']);
                $redisConfig->setTimeout($rsConfig['timeout']);
                // 注册连接池管理对象
                Manager::getInstance()->register(new RedisPool($config, $redisConfig), $this->mainRedis);
                //测试redis
                $this->testPool();
            }
            $this->logMessage('use pool:' . $server->worker_pid);
        } catch (Exception $e) {
            $this->logMessage('initPool error:' . $e->getMessage());
        }
    }

    public function onWorkerStop(Server $server, int $workerId)
    {
        $this->logMessage('worker stop, worker_pid:' . $server->worker_pid);
        try {
            $this->logMessage('pool close');
            $this->clearTimer();
        } catch (Exception $e) {
            $this->logMessage('pool close error:' . $e->getMessage());
        }
    }

    //回调方法为协程容器环境，可以直接使用协程api
    public function onRequest(Request $request, Response $response)
    {
        try {
            //$startTime = time();
            //数据库配置信息
            //$mysqlClient = $this->getMysqlObject();
            //转发请求
            $dispatcher = new Dispatcher($request, $response);
            $dispatcher->dispatch();
            $return = ['code' => 200, 'message' => 'success', 'data' => $dispatcher->getResult()];
        } catch (Exception $e) {
            $return = ['code' => 201, 'message' => $e->getMessage(), 'data' => []];
        }
        //返回响应
        //$this->logMessage('done');
        $response->header('Content-Type', 'application/json;charset=utf-8');
        return $response->end(json_encode($return));
    }

    private function logMessage($logData)
    {
        $logData = (is_array($logData) || is_object($logData)) ? json_encode($logData, JSON_UNESCAPED_UNICODE) : $logData;
        echo date('[Y-m-d H:i:s]') . $logData . PHP_EOL;
    }

    /**
     * @param bool $force
     * @throws Exception
     */
    private function stop($force = false)
    {
        $pidFile = MODULE_DIR . '/logs/' . $this->pidFile;
        if (!file_exists($pidFile)) {
            throw new Exception('server not running');
        }
        $pid = file_get_contents($pidFile);
        if (!Process::kill($pid, 0)) {
            unlink($pidFile);
            throw new Exception("pid not exist:{$pid}");
        } else {
            if ($force) {
                Process::kill($pid, SIGKILL);
            } else {
                Process::kill($pid);
            }
        }
    }

    /**
     * @throws Exception
     */
    private function status()
    {
        $pidFile = MODULE_DIR . '/logs/' . $this->pidFile;
        if (!file_exists($pidFile)) {
            throw new Exception('server not running');
        }
        $pid = file_get_contents($pidFile);
        //$signo=0，可以检测进程是否存在，不会发送信号
        if (!Process::kill($pid, 0)) {
            echo 'not running, pid:' . $pid . PHP_EOL;
        } else {
            echo 'running, pid:' . $pid . PHP_EOL;
        }
    }

    /**
     * @return MysqliClient
     */
    private function getMysqlObject()
    {
        // 获取连接池
        $connection = DbManager::getInstance()->getConnection($this->mainMysql);
        $timeout = null;
        //即 createObject()对象，->defer($timeout)参数为空 默认获取config的timeout，此方法会自动回收对象，用户无需关心。
        /* @var  $mysqlClient MysqliClient */
        $mysqlClient = $connection->defer($timeout);
        return $mysqlClient;
    }

    /**
     * @return mixed
     * @throws PoolEmpty
     */
    private function getRedisObject()
    {
        // 获取连接池
        $redisPool = Manager::getInstance()->get($this->mainRedis);
        $timeout = null;
        $redis = $redisPool->defer($timeout);
        return $redis;
    }

    //连接池对象注意点：
    //1，需要定期检查是否可用；
    //2，需要定期更新对象，防止在任务执行过程中连接断开（记录最后获取，使用时间，定时校验对象是否留存超时）
    public function checkPool()
    {
        if (true) {
            return 'not support now';
        }
        $this->availableTimerId = Timer::tick($this->checkAvailableTime * 1000, function () {

        });

        $this->liveTimerId = Timer::tick($this->checkLiveTime * 1000, function () {
        });
        return true;
    }

    private function clearTimer()
    {
        if ($this->availableTimerId) {
            Timer::clear($this->availableTimerId);
        }
        if ($this->liveTimerId) {
            Timer::clear($this->liveTimerId);
        }
    }

    private function createTable()
    {
        if (true) {
            return 'not support now';
        }
        //存储数据size，即mysql总行数
        $size = 1024;
        $this->poolTable = new Table($size);
        $this->poolTable->column('created', Table::TYPE_INT, 10);
        $this->poolTable->column('pid', Table::TYPE_INT, 10);
        $this->poolTable->column('inuse', Table::TYPE_INT, 10);
        $this->poolTable->column('loadWaitTimes', Table::TYPE_FLOAT, 10);
        $this->poolTable->column('loadUseTimes', Table::TYPE_INT, 10);
        $this->poolTable->column('lastAliveTime', Table::TYPE_INT, 10);
        $this->poolTable->create();
        return true;
    }

    private function testPool()
    {
        //测试mysql
        //$mysqlClient = $this->getMysqlObject();

        //测试redis
        $redis = $this->getRedisObject();
        $key = 'co-server-redis-test';
        $redis->set($key, 'a:' . mt_rand(1000, 9999) . ':' . date('Y-m-d H:i:s'), 120);
        $result = $redis->get($key);
        $this->logMessage('redisTest:' . $result);
        $redis->del($key);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    protected function databaseConfig()
    {
        $configDir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;
        $filePath = $configDir . 'database.php';
        if (!file_exists($filePath)) {
            throw new \Exception('database config not exist:' . $filePath);
        }
        return include_once($filePath);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    protected function redisConfig()
    {
        $configDir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;
        $filePath = $configDir . 'redis.php';
        if (!file_exists($filePath)) {
            throw new \Exception('redis config not exist:' . $filePath);
        }
        return include_once($filePath);
    }
}