<?php


namespace Justlzz\Solutions\Language\Php\Frame\Laravel\Middleware;


class SetCookie implements MiddlewareInterface
{
    public static function handler(\Closure $next)
    {
        $next();
        echo "设置cookie" . PHP_EOL;
    }
}