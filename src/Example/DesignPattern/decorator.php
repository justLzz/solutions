<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\DesignPattern\Decorator\People;
use Justlzz\Solutions\DesignPattern\Decorator\Age;
use Justlzz\Solutions\DesignPattern\Decorator\Sex;

$a = new People();
$a->addDecorator(new Age());
$a->addDecorator(new Sex());
$a->index();
