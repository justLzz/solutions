<?php

namespace Justlzz\Solutions\Database\Nosql\Redis\CurrentLimiting;

use Justlzz\Solutions\Language\Php\Base\DealFunction\DealTime;
use Redis;

/**
 * 滑动窗口限流
 * Class SlidingWindow
 * @package Justlzz\Solutions\Database\Nosql\Redis\CurrentLimiting
 */
class SlidingWindow
{
    protected $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Notes:redis限流
     * @param $scene
     * @param $time
     * @param $count
     * @return bool
     */
    public function isLimit($scene, $time, $count) : bool
    {
        $key = sprintf('limiting:%s', $scene);
        $now = DealTime::msectime();
        $pipe = $this->redis->multi();
        $pipe->zAdd($key, $now, $now);
        $pipe->zRemRangeByScore($key,0,$now-$time);
        $pipe->zCard($key);
        $pipe->expire($key, $time/1000 + 1);
        $res = $pipe->exec();
        return $res[2] <= $count;
    }
}