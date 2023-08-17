<?php

require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Language\Php\Frame\Laravel\Ioc\Ioc;
use Justlzz\Solutions\Language\Php\Frame\Laravel\Ioc\DbLog;
use Justlzz\Solutions\Language\Php\Frame\Laravel\Ioc\FileLog;
use Justlzz\Solutions\Language\Php\Frame\Laravel\Ioc\User;
use Justlzz\Solutions\Language\Php\Frame\Laravel\Ioc\LogInterface;
use Justlzz\Solutions\Language\Php\Frame\Laravel\Facade\UserFacade;

$ioc = new Ioc;
$ioc->bind(LogInterface::class, DbLog::class);
$ioc->bind('User', User::class);

UserFacade::setFacadeIoc($ioc);
UserFacade::login();