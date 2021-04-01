<?php


namespace Justlzz\Solutions\Language\Php\Frame\Laravel\Middleware;


class VerifyAuth implements MiddlewareInterface
{
    public static function handler(\Closure $next)
    {
        echo "验证是否登录" . PHP_EOL;
        $next();
    }
}