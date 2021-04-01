<?php


namespace Solutions\Language\Php\Frame\Laravel\Facade;

use Solutions\Language\Php\Frame\Laravel\Ioc\Ioc;

abstract class Facade
{
    protected static $ioc;

    public static function setFacadeIoc(Ioc $ioc)
    {
        static::$ioc = $ioc;
    }

    abstract protected static function getFacadeAccessor();

    public static function __callStatic($method, $arguments)
    {
        $instance = static::$ioc->make(static::getFacadeAccessor());
        return $instance->$method(...$arguments);
    }
}