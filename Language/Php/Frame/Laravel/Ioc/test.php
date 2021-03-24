<?php
require '/html/www/Solutions/autoloader.php';

use Solutions\Language\Php\Frame\Laravel\Ioc\Ioc;
use Solutions\Language\Php\Frame\Laravel\Ioc\DbLog;
use Solutions\Language\Php\Frame\Laravel\Ioc\FileLog;
use Solutions\Language\Php\Frame\Laravel\Ioc\User;
use Solutions\Language\Php\Frame\Laravel\Ioc\LogInterface;

$ioc = new Ioc;
$ioc->bind(LogInterface::class, DbLog::class);
$ioc->bind('User', User::class);

$user = $ioc->make('User');
$user->login();