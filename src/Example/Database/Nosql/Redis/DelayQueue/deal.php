<?php

require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Example\Database\Nosql\Redis\DelayQueue\Task;
use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Database\Nosql\Redis\Redis;

$config = new Config('redis');

$redis = Redis::getInstance($config);

$task = new Task($redis, $config, 'order_test');

while (true)
{
    if (!$res = $task->run())
    {
        sleep(1);
    } else {
        $res = json_decode($res, true);
        //处理任务
        echo '任务：' . $res['task_name'] . ' 处理时间：' . date('Y-m-d H:i:s') . PHP_EOL;
    }
}
