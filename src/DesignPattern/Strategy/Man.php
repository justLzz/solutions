<?php


namespace Justlzz\Solutions\DesignPattern\Strategy;


class Man implements People
{
    public function favoriteClass()
    {
        return "电脑，手表" . PHP_EOL;
    }

    public function favoriteColor()
    {
        return "黑色，黄色" . PHP_EOL;
    }
}