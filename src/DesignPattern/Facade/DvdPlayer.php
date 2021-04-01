<?php


namespace Justlzz\Solutions\DesignPattern\Facade;


class DvdPlayer
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
        echo "打开DVD" . PHP_EOL;
    }

    public function play()
    {
        echo "播放DVD" . PHP_EOL;
    }

    public function stop()
    {
        echo "停止播放DVD" . PHP_EOL;
    }

    public function off()
    {
        echo "关闭DVD" . PHP_EOL;
    }

}