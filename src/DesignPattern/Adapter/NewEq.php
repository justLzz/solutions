<?php


namespace Justlzz\Solutions\DesignPattern\Adapter;


class NewEq implements NewEqInterface
{
    public function startUp()
    {
        echo "打开一个设备" . PHP_EOL;
    }

    public function close()
    {
        echo "关闭一个设备" . PHP_EOL;
    }
}