<?php


namespace Solutions\Language\Php\Frame\Laravel\Middleware;


interface MiddlewareInterface
{
    public static function handler(\Closure $next);
}