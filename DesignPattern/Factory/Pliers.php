<?php


namespace Solutions\DesignPattern\Factory;


class Pliers implements Tool
{
    public function use()
    {
        echo "使用钳子" . PHP_EOL;
    }
}