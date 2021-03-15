<?php


namespace Solutions\Database\Sql\Mysql;

use Solutions\Database\Sql\Mysql\Mysql;

//数据库的锁
class Lock extends Mysql
{

    public function readLock()
    {

    }

    public function writeLock()
    {

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