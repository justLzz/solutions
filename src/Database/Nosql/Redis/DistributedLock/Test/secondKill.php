<?php

require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Database\Nosql\Redis\DistributedLock\Simple;

$workerId = $argv[1]; //swoole多进程传入的工作进程id
$scene = 'secondKill';

$lockTool = new Simple();

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

//Swoole模拟多进程获取锁详见Test
