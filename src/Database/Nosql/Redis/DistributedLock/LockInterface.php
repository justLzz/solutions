<?php


namespace Justlzz\Solutions\Database\Nosql\Redis\DistributedLock;


interface LockInterface
{
    /**
     * Notes: 加锁
     * Date: 2021/3/8
     * Time: 14:20
     * @param String $scene
     * @param Int $expire_time
     * @param Int $retry_times
     * @param Int $usleep
     * @return mixed
     */
    public function lock(String $scene,Int $expire_time,Int $retry_times = 3, Int $usleep = 100000);
    public function unlock(String $scene);
}