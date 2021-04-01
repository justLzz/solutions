<?php


namespace Justlzz\Solutions\DesignPattern\Strategy;


class Women implements People
{
    public function favoriteClass()
    {
        echo "衣服，皮包" . PHP_EOL;
    }

    public function favoriteColor()
    {
        echo "粉色，绿色" . PHP_EOL;
    }
}