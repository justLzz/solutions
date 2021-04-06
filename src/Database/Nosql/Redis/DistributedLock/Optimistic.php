<?php


namespace Justlzz\Solutions\Database\Nosql\Redis\DistributedLock;

use Redis;

/**
 * 利用redis watch命令实现，类似于乐观锁
 * Class Optimistic
 * @package Solutions\Database\Nosql\Redis\DistributedLock
 */
class Optimistic implements LockInterface
{

    public $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Notes:
     * User: Admin
     * Date: 2021/3/29
     * Time: 13:52
     * @param string $scene 要监控的键
     * @param int $expire_time
     * @param int $retry_times
     * @param int $usleep
     * @return mixed|void
     */
    public function lock(string $scene, int $expire_time=0, int $retry_times = 3, int $usleep = 100000)
    {
        $this->redis->watch($scene);
        $res = $this->redis->get($scene);
        $this->redis->multi();
        return $res;
    }

    public function unlock(string $scene = null)
    {
        return $this->redis->exec();
    }
}