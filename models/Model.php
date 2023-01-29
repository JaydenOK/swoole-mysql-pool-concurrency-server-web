<?php

namespace module\models;

use EasySwoole\ORM\Db\ClientInterface;
use EasySwoole\ORM\DbManager;
use Swoole\Coroutine;

class Model
{
    /**
     * 共用DB
     * @var []\EasySwoole\ORM\Db\MysqliClient
     */
    protected static $dbPool;

    protected static $db;

    /**
     * @var string
     */
    protected static $main = 'mainMysql';
    /**
     * @var []static
     */
    protected static $models;

    public function __construct($className = __CLASS__)
    {
        self::getDb();
    }

    /**
     * @param string $className
     * @return static
     */
    public static function model($className = __CLASS__)
    {
        if (!isset(self::$models[$className])) {
            self::$models[$className] = new static($className);
        }
        return self::$models[$className];
    }

    /**
     * 需使用协程唯一ID隔离Coroutine::getCid()，连接池已处理此逻辑，直接获取
     *
     * 对于一个 TCP 连接来说 Swoole 底层允许同时只能有一个协程进行读操作、一个协程进行写操作。也就是说不能有多个协程对一个 TCP 进行读 / 写操作，底层会抛出绑定错误:
     * 此限制对于所有多协程环境都有效，最常见的就是在 onReceive 等回调函数中去共用一个 TCP 连接，因为此类回调函数会自动创建一个协程，
     * 那有连接池需求怎么办？Swoole 内置了连接池可以直接使用，或手动用 channel 封装连接池。
     *
     * @return \EasySwoole\ORM\Db\MysqliClient
     */
    public static function getDb()
    {
        $cid = Coroutine::getCid();
        if ($cid < 0) {
            return null;
        }
        if (!isset(self::$dbPool[$cid])) {
            self::$dbPool[$cid] = self::getMysqlObject();
        }
        return self::$dbPool[$cid];
    }

    /**
     * @return \EasySwoole\ORM\Db\MysqliClient
     */
    private static function getMysqlObject()
    {
        $connection = DbManager::getInstance()->getConnection(self::$main);
        $timeout = null;
        //即 createObject()对象，->defer($timeout)参数为空 默认获取config的timeout，此方法会自动回收对象，用户无需关心。
        /* @var  $mysqlClient \EasySwoole\ORM\Db\MysqliClient */
        $mysqlClient = $connection->defer($timeout);
        if (!$mysqlClient instanceof ClientInterface) {
            throw new \Exception("MysqlClient is not instanceof ClientInterface");
        }
        return $mysqlClient;
    }

    public function tableName()
    {
        return '';
    }

    public function insertData($data)
    {
        self::getDb()->queryBuilder()->insert($this->tableName(), $data);
        // 获取最后插入的insert_id 使用客户端从swoole mysql获取
        return self::getDb()->mysqlClient()->insert_id;
    }

    public function saveData($data, $where)
    {
        foreach ($where as $key => $value) {
            self::getDb()->queryBuilder()->where($key, $value);
        }
        self::getDb()->queryBuilder()->update($this->tableName(), $data);
        return self::getDb()->mysqlClient()->affected_rows;
    }

    public function findOne($where, $columns = '*')
    {
        foreach ($where as $key => $value) {
            self::getDb()->queryBuilder()->where($key, $value);
        }
        self::getDb()->queryBuilder()->getOne($this->tableName(), $columns);
        return self::getDb()->execBuilder();
    }

    public function findAll($where, $numRows = null, $columns = null)
    {
        foreach ($where as $key => $value) {
            self::getDb()->queryBuilder()->where($key, $value);
        }
        self::getDb()->queryBuilder()->get($this->tableName(), $numRows, $columns);
        return self::getDb()->execBuilder();
    }

}