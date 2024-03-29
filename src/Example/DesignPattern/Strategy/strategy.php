<?php

require __DIR__ . "/../../../../vendor/autoload.php";

use Justlzz\Solutions\DesignPattern\Strategy\Women;
use Justlzz\Solutions\DesignPattern\Strategy\Man;
use Justlzz\Solutions\DesignPattern\Strategy\Strategy;

$strategy = new Strategy();

$manFColor = $strategy->getItem(Man::class)->fColor();

echo $manFColor;

$womenFColor = $strategy->getItem(Women::class)->fColor();

echo $womenFColor;