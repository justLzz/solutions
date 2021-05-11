<?php


namespace Justlzz\Solutions\Database\Nosql\Redis\CurrentLimiting;

/**
 * 基于字符串自增实现限流效果，秒级限流
 * Class StringIncrLimit
 * @package Justlzz\Solutions\Database\Nosql\Redis\CurrentLimiting
 */
class StringIncrLimit
{
    private static $instance;

    private $redis;

    private $limitPre = 'limit_';

    private $ex = 10;

    /**
     * 每秒为单位
     * @var int
     */
    private $limitNum = 10;

    private function __construct(\Redis $redis)
    {
        $this->redis = $redis;
    }

    public static function getInstance(\Redis $redis)
    {
        if(!self::$instance) self::$instance = new self($redis);
        return self::$instance;
    }

    public function setLimitPre(String $pre)
    {
        $this->limitPre = $pre;
        return $this;
    }

    public function setLimitNum(Int $num)
    {
        $this->limitNum = $num;
        return $this;
    }

    public function setEx(Int $time)
    {
        if ($time <= 1) throw new \Exception('time is must > 1');
        $this->ex = $time;
        return $this;
    }

    public function checkLimit()
    {
        $key = $this->getKey();
        if ($this->redis->incr($key) > $this->limitNum) return false;
        $this->redis->expire($key, $this->ex);
        return true;
    }

    public function getKey()
    {
        return $this->limitPre . time();
    }

}