<?php


namespace Justlzz\Solutions\Php\Frame\Laravel\Ioc;


class FileLog implements LogInterface
{
    public function write()
    {
        echo "将log写入文件" . PHP_EOL;
    }
}