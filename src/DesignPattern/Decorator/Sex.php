<?php


namespace Solutions\DesignPattern\Decorator;


class Sex implements Decorator
{
    public function before()
    {
        echo '我爱好女' . PHP_EOL;
    }

    public function after()
    {
        echo '我还是爱好女' . PHP_EOL;
    }
}