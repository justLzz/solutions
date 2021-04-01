<?php
/**
 * 获取redis单例
 */
namespace Justlzz\Solutions\Database\Nosql\Redis;

use Justlzz\Solutions\Database\Contracts\Common as DatabaseCommon;

class Redis implements  DatabaseCommon{

    private static $config = [
        'host' => '172.17.0.1',
        'port' => 6379,
        'select' => 0,
        'auth' => '',
    ];

    private static $redis = null;

    private function __construct()
    {
        try {
            $redis = new \Redis();
            $redis->connect(self::$config['host'],self::$config['port']);
            if (self::$config['auth']) $redis->auth(self::$config['port']);
            if (self::$config['select']) $redis->select(self::$config['select']);
            self::$redis = $redis;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    private function __clone(){}

    public static function getInstance()
    {
        if (is_null(self::$redis))
        {
            new self;
        }
        return self::$redis;
    }


}