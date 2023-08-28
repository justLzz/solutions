<?php

namespace Justlzz\Solutions\Database\Nosql\Redis\BloomFilter;

abstract class BloomFilter
{
    /**
     * 需要使用一个方法来定义bucket的名字
     */
    protected $bucket;

    protected $hashFunction;

    protected $hash;

    protected $redis;

    public function __construct(\Redis $redis)
    {
        if (!$this->bucket || !$this->hashFunction) throw new \Exception("需要定义bucket和hashFunction");
        $this->hash = new HashFunc;
        $this->redis = $redis;
    }

    /**
     * 添加到集合中
     */
    public function add($string)
    {
        $pipe = $this->redis->multi();
        foreach ($this->hashFunction as $function) {
            $hash = $this->hash->$function($string);
            $pipe->setBit($this->bucket, $hash, 1);
        }
        return $pipe->exec();
    }

    /**
     * 查询是否存在, 存在的一定会存在, 不存在有一定几率会误判
     */
    public function exists($string)
    {
        $pipe = $this->redis->multi();
        $len = strlen($string);
        foreach ($this->hashFunction as $function) {
            $hash = $this->hash->$function($string, $len);
            $pipe = $pipe->getBit($this->bucket, $hash);
        }
        $res = $pipe->exec();
        foreach ($res as $bit) {
            if ($bit == 0) {
                return false;
            }
        }
        return true;
    }
}