<?php

namespace module\models;

use EasySwoole\ORM\DbManager;

class Model
{
    /**
     * 共用DB
     * @var \EasySwoole\ORM\Db\MysqliClient
     */
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
     * @return \EasySwoole\ORM\Db\MysqliClient
     */
    public static function getDb()
    {
        if (is_null(self::$db)) {
            self::$db = self::getMysqlObject();
        }
        return self::$db;
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
        return $mysqlClient;
    }

    public function tableName()
    {
        return '';
    }

    public function insertData($data)
    {
        self::$db->queryBuilder()->insert($this->tableName(), $data);
        // 获取最后插入的insert_id 使用客户端从swoole mysql获取
        return self::$db->mysqlClient()->insert_id;
    }

    public function saveData($data, $where)
    {
        foreach ($where as $key => $value) {
            self::$db->queryBuilder()->where($key, $value);
        }
        self::$db->queryBuilder()->update($this->tableName(), $data);
        return self::$db->mysqlClient()->affected_rows;
    }

    public function findOne($where, $columns = '*')
    {
        foreach ($where as $key => $value) {
            self::$db->queryBuilder()->where($key, $value);
        }
        self::$db->queryBuilder()->getOne($this->tableName(), $columns);
        return self::$db->execBuilder();
    }

    public function findAll($where, $numRows = null, $columns = null)
    {
        foreach ($where as $key => $value) {
            self::$db->queryBuilder()->where($key, $value);
        }
        self::$db->queryBuilder()->get($this->tableName(), $numRows, $columns);
        return self::$db->execBuilder();
    }

}