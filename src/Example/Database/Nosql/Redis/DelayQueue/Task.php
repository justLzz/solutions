<?php


namespace Justlzz\Solutions\Example\Database\Nosql\Redis\DelayQueue;


use Justlzz\Solutions\Database\Nosql\Redis\DelayQueue\Task as AbTask;

class Task extends AbTask
{
    public function deal($value) : bool
    {
       return $this->redis->zRem($this->key, $value);
    }
}