<?php


namespace Justlzz\Solutions\Php\Frame\Laravel\Ioc;


class DbLog implements LogInterface
{
    public function write()
    {
        echo "将log写入数据库" . PHP_EOL;
    }
}