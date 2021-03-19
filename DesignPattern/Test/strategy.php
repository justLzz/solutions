<?php

require '/html/www/Solutions/autoloader.php';

use Solutions\DesignPattern\Strategy\Women;
use Solutions\DesignPattern\Strategy\Man;
use Solutions\DesignPattern\Strategy\Strategy;

$strategy = new Strategy();

$manFColor = $strategy->getItem(Man::class)->fColor();

$womenFColor = $strategy->getItem(Women::class)->fColor();