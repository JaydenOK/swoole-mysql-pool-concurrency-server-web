<?php
//与 Http\Server 的不同之处：
//可以在运行时动态地创建、销毁
//对连接的处理是在单独的子协程中完成，客户端连接的 Connect、Request、Response、Close 是完全串行的

//编程范式
//协程内部禁止使用全局变量
//协程使用 use 关键字引入外部变量到当前作用域禁止使用引用
//协程之间通讯必须使用 Channel

//在协程编程中可直接使用 try/catch 处理异常。但必须在协程内捕获(协程函数内try/catch)，不得跨协程捕获异常。

//不能在多个协程间共用一个TCP连接(Mysql,Redis,Mongo,Http)，与同步阻塞程序不同，协程是并发处理请求的，因此同一时间可能会有很多个请求在并行处理，一旦共用客户端连接，就会导致不同协程之间发生数据错乱。

//使用类静态变量 / 全局变量保存上下文;多个协程是并发执行的，因此不能使用类静态变量 / 全局变量保存协程上下文内容。使用局部变量是安全的，因为局部变量的值会自动保存在协程栈中，其他协程访问不到协程的局部变量。（协程a设置了全局变量V，然后先被协程b修改了，协程a后面会获取到修改后的变量V）
//可以使用一个 Context 类来管理协程上下文，在 Context 类中，使用 Coroutine::getuid 获取了协程 ID，然后隔离不同协程之间的全局变量，协程退出时清理上下文数据
//获取当前协程的上下文对象。Swoole\Coroutine::getContext([int $cid = 0]): Swoole\Coroutine\Context

namespace module\lib;

use module\controllers\Controller;
use Swoole\Http\Request;
use Swoole\Http\Response;

class Dispatcher
{
    /**
     * 模块（即目录名）
     * @var string
     */
    private $module;
    /**
     * @var string
     */
    private $controller;
    /**
     * 方法，默认执行run方法
     * @var string
     */
    private $action = 'run';
    /**
     * 控制器所在空间，有且只有第一个大写字母
     * @var Controller
     */
    private $className;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Response
     */
    private $response;
    private $result;


    public function __construct(Request $request = null, Response $response = null)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function dispatch()
    {
        $uriArr = explode('/', trim($this->request->server['request_uri'], '/'));
        $this->controller = $uriArr[0] ?? '';
        $this->action = $uriArr[1] ?? '';
        if (empty($this->controller) || empty($this->action)) {
            throw new \Exception("Not Found");
        }
        //加上命名空间
        $this->className = 'module\\controllers\\' . ucfirst($this->controller);
        if (!class_exists($this->className)) {
            throw new \Exception("Not Found.");
        }
        if (!method_exists($this->className, $this->action)) {
            throw new \Exception("NOT FOUND");
        }
        $controller = new $this->className($this->request->get, $this->request->post, $this->request->rawContent(), $this->request->header);
        $this->result = call_user_func_array([$controller, $this->action], []);
    }

    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

}