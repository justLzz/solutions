<?php

require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Database\Nosql\Redis\DistributedLock\Pessimism;
use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Database\Nosql\Redis\Redis;

$config = new Config('redis');

$redis = Redis::getInstance($config);

$workerId = $argv[1]; //swoole多进程传入的工作进程id
$scene = 'secondKill';

$lockTool = new Pessimism($redis);

$lock = $lockTool->lock($scene);
if ($lock)
{
    try {
        sleep(2);
    } finally {
        $lockTool->unlock($scene);
        echo $workerId  . '进程获取到锁处理完毕并删除锁' . PHP_EOL;
    }
} else {
    echo $workerId  . '未获取到锁' . PHP_EOL;
}

