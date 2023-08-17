<?php


namespace Justlzz\Solutions\Php\Frame\Laravel\Facade;


class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'User';
    }
}