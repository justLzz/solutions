<?php


namespace Justlzz\Solutions\Database\Nosql\Redis\DelayQueue;

use Redis;
use Justlzz\Solutions\Config\ConfigInterface;

abstract class Task
{

    public $redis;
    public $prefix;
    public $key = '';

    public function __construct(Redis $redis, ConfigInterface $redisConfig, $queueName = '')
    {
        $this->redis = $redis;
        $this->prefix = $redisConfig->toArray()['delay_queue_prefix'];
        $this->key = $this->prefix . $queueName;
    }

    public function add($name, $time, $data)
    {
        return $this->redis->zAdd($this->key,
                            $time,
                            json_encode(['task_name' => $name, 'task_time' => $time, 'task_data' => $data], JSON_UNESCAPED_UNICODE));
    }

    abstract public function deal($value) : bool;

    //取过期时间到现在的1条数据
    public function get()
    {
        return $this->redis->zRangeByScore($this->key, 0, time(), ['limit' => [0, 1]]);
    }

    public function run()
    {
        $task = $this->get();
        if (empty($task)) return false;
        $task = $task[0];
        if ($this->deal($task)) return $task;
        return false;
    }
}