<?php

require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Database\Sql\Mysql\Lock;
use Justlzz\Solutions\Config\Config;

$config = new Config('mysql','/html/www/Solutions/src/Config');

try {
    $lock = new Lock($config);
    $lock->pdo->beginTransaction();
    //事务提交之前，这一行被锁住，其他事务无法操作
    //$lock->table('test')->where('id','=',1280026)->pessimisticLock()->select();
    //或者直接使用update，mysql或自动加上行锁
    $res = $lock->table('test')->where('id','=',12)->update(['uuid'=>123123, 'name'=>2222]);
    //sleep,防止断开连接
    sleep(20);
}catch (\Exception $exception)
{
    echo $exception->getMessage();
}

