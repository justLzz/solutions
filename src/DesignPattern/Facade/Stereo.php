<?php


namespace Solutions\DesignPattern\Facade;


class Stereo
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
        echo "打开音响" . PHP_EOL;
    }

    public function up()
    {
        echo "放大音量" . PHP_EOL;
    }

    public function down()
    {
        echo "放小音量" . PHP_EOL;
    }

    public function off()
    {
        echo "关闭音响" . PHP_EOL;
    }
}