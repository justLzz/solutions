<?php

require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Database\Sql\Mysql\Lock;
use Justlzz\Solutions\Config\Config;

$config = new Config('mysql');

try {
    $lock = new Lock($config);
    $lock->pdo->beginTransaction();
    //事务提交之前，这一行被锁住，其他事务无法操作
    $a = $lock->table('test')->where('uuid','=',123123)->pessimisticLock()->select();
    $num = $a[0]['num'];
    var_dump($num);
    if ($num < 1) echo "库存不足";
    sleep(30);
    //或者直接使用update，mysql或自动加上行锁
    $res = $lock->table('test')->where('uuid','=',123123)->update(['num' => $num - 1]);
    //sleep,防止断开连接
    sleep(20);
    $lock->pdo->commit();

}catch (\Exception $exception)
{
    echo $exception->getMessage();
}

