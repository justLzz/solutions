<?php


namespace Justlzz\Solutions\DesignPattern\Facade;


class Screen
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

    public function down()
    {
        echo "放下幕布" . PHP_EOL;
    }

    public function up()
    {
        echo "升起幕布" . PHP_EOL;
    }
}