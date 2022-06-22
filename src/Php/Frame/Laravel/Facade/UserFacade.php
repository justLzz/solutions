<?php


namespace Justlzz\Solutions\Language\Php\Frame\Laravel\Facade;


class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'User';
    }
}