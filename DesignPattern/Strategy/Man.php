<?php


namespace Solutions\DesignPattern\Strategy;


class Man implements People
{
    public function favoriteClass()
    {
        echo "电脑，手表" . PHP_EOL;
    }

    public function favoriteColor()
    {
        echo "黑色，黄色" . PHP_EOL;
    }
}