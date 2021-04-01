<?php
require '/html/www/Solutions/autoloader.php';

use Solutions\DesignPattern\Decorator\People;
use Solutions\DesignPattern\Decorator\Age;
use Solutions\DesignPattern\Decorator\Sex;

$a = new People();
$a->addDecorator(new Age());
$a->addDecorator(new Sex());
$a->index();
