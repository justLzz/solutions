<?php


namespace Justlzz\Solutions\DesignPattern\Factory;


class Hammer implements Tool
{
    public function use()
    {
        echo "使用锤子" . PHP_EOL;
    }
}