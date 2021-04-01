<?php

require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Database\Nosql\Redis\DistributedLock\Optimistic;

$workerId = $argv[1]; //多进程传入的工作进程id
$scene = 'secondKill';
$optimisticLock = new Optimistic();

//抢购开始之前新建库存
//$optimisticLock->redis->set($scene,200);

//获取当前库存
$num = $optimisticLock->redis->get($scene);

$optimisticLock->lock($scene);

//减库存
if ($num>0) {
    $optimisticLock->redis->decr($scene);
} else {
    echo $workerId . "没有库存" .PHP_EOL;
}

$res = $optimisticLock->unlock();
if ($res) {
    echo $workerId . "库存减少成功" . PHP_EOL;
    //订单逻辑
} else {
    echo $workerId . "失败" .PHP_EOL;
}

