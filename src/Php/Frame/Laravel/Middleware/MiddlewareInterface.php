<?php


namespace Justlzz\Solutions\Php\Frame\Laravel\Middleware;


interface MiddlewareInterface
{
    public static function handler(\Closure $next);
}