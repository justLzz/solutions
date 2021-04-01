<?php


namespace Justlzz\Solutions\DesignPattern\Register;


class Tree
{
    protected static $tree = [];

    public static function set($k, $v)
    {
        self::$tree[$k] = $v;
    }

    public static function get($k)
    {
        return self::$tree[$k];
    }
}