<?php


namespace Justlzz\Solutions\Database\Sql\Mysql;

use Justlzz\Solutions\Database\Sql\Mysql\Mysql;

//数据库的锁
class Lock extends Mysql
{

    //悲观锁和乐观锁一把处理高并发写入，例如防止超卖等

    //悲观锁利用数据库的行锁，锁住要操作的那一行
    public function pessimisticLock()
    {
        $this->writeLock();
        return $this;
    }

    //乐观锁可以利用数据表加一个version字段
    public function optimisticLock()
    {

    }

    //间隙锁其实就是锁定一个范围
    public function clearanceLock()
    {

    }

    public function readLock()
    {
        $this->prepareSql .= 'lock in share mode';
    }

    public function  writeLock()
    {
        $this->prepareSql .= 'for update';
    }

    public function  beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commitTransaction()
    {
        $this->pdo->commit();
    }

    public function rollBack()
    {
        $this->pdo->rollBack();
    }

}