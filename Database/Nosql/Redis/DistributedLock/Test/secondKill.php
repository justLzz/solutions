<?php

require '/html/www/Solutions/autoloader.php';

use Solutions\Database\Nosql\Redis\DistributedLock\Simple;

$scene = 'secondKill';

$lockTool = new Simple();

$lock = $lockTool->lock($scene);
if ($lock)
{
    try {
        sleep(2);
    } finally {
        $lockTool->unlock($scene);
        echo '获取到锁处理完毕并删除锁' . PHP_EOL;
    }
} else {
    echo '未获取到锁' . PHP_EOL;
}

//Swoole模拟多进程获取锁详见Test
