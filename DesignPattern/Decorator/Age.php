<?php


namespace Solutions\DesignPattern\Decorator;


class Age implements Decorator
{
    public function before()
    {
        echo '我27岁' . PHP_EOL;
    }

    public function after()
    {
        echo '我37岁' . PHP_EOL;
    }
}