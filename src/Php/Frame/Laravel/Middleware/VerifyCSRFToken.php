<?php


namespace Justlzz\Solutions\Php\Frame\Laravel\Middleware;


class VerifyCSRFToken implements MiddlewareInterface
{
    public static function handler(\Closure $next)
    {
        echo "验证CSRFToken" . PHP_EOL;
        $next();
    }
}