<?php


namespace Justlzz\Solutions\Config;


class Env
{
    public static $envArray;

    public static function get($key)
    {
        if (!self::$envArray) self::$envArray = parse_ini_file(self::getEvnPath(), true);
        $keyArray = explode('.',$key);
        return isset(self::$envArray[$keyArray[0]][$keyArray[1]]) ? self::$envArray[$keyArray[0]][$keyArray[1]] : null;
    }

    public static function getEvnPath()
    {
        return dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . '.env';
    }
}