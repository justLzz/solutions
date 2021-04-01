<?php


namespace Solutions\DesignPattern\Facade;


class Popcorn
{
    public static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {}

    private function __clone() {}

    public function on()
    {
        echo "打开爆米花机" . PHP_EOL;
    }

    public function off()
    {
       echo "关闭爆米花机" . PHP_EOL;
    }

    public function make()
    {
        echo "制作爆米花" . PHP_EOL;
    }
}