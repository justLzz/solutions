<?php

require '/html/www/Solutions/autoloader.php';

use Solutions\Database\Sql\Mysql\Lock;

try {
    $lock = new Lock();
    $lock->pdo->beginTransaction();
    //事务提交之前，这一行被锁住，其他事务无法操作
    //$lock->table('test')->where('id','=',1280026)->pessimisticLock()->select();
    //或者直接使用update，mysql或自动加上行锁
    $res = $lock->table('test')->where('id','=',1280026)->update(['uuid'=>123123, 'name'=>2222]);
    //sleep,防止断开连接
    sleep(20);
}catch (\Exception $exception)
{
    echo $exception->getMessage();
}

