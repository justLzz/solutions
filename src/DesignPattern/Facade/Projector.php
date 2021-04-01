<?php


namespace Solutions\DesignPattern\Facade;


class Projector
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
        echo "打开投影仪" . PHP_EOL;
    }

    public function off()
    {
        echo "关闭投影仪" . PHP_EOL;
    }
}