<?php
/**
 * 获取redis单例
 */
namespace Justlzz\Solutions\Database\Nosql\Redis;

use Justlzz\Solutions\Database\Contracts\Common as DatabaseCommon;
use Justlzz\Solutions\Config\ConfigInterface;

class Redis implements  DatabaseCommon{

    private static $config;

    private static $redis = null;

    private function __construct(ConfigInterface $config)
    {
        try {
            self::$config = $config->toArray();
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

    public static function getInstance($config)
    {
        if (is_null(self::$redis))
        {
            new self($config);
        }
        return self::$redis;
    }


}