<?php


namespace Solutions\DesignPattern\Adapter;


class OldEq implements EqInterface
{
    public function on()
    {
        echo "打开一个设备" . PHP_EOL;
    }

    public function off()
    {
        echo "关闭一个设备" . PHP_EOL;
    }
}