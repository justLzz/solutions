<?php

namespace Justlzz\Solutions\Database\Nosql\Redis\DistributedLock;

use Redis;

/**
 * redis获取锁的方式类似于悲观锁
 * Class Simple
 * @package Solutions\Database\Nosql\Redis\DistributedLock
 */
class Pessimism implements LockInterface
{
    public $lockId = [];

    public $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function lock(String $scene,Int $expire_time = 10,Int $retry_times = 3, Int $usleep = 100000)
    {
        while ($retry_times > 0) {
            //开始获取锁
            $uniqueId = session_create_id();
            $lock = $this->redis->set($scene, $uniqueId, ['NX', 'EX' => $expire_time]);
            if ($lock) {
                break;
            }
            $retry_times--;
            usleep($usleep);
        }
        $this->lockId[$scene] = $uniqueId;
        return $lock;
    }

    public function unlock(String $scene)
    {
        $lock_value = $this->lockId[$scene];
        if ($lock_value) {
            $script = <<<LUA
                if (redis.call("get", KEYS[1]) == ARGV[1])
                then
                    return redis.call("del", KEYS[1])
                else 
                    return 0
                end
LUA;
            $this->redis->eval($script, [$scene, $lock_value], 1);
        }
    }
}