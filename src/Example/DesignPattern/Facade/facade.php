<?php
require __DIR__ . "/../../../../vendor/autoload.php";

use Justlzz\Solutions\DesignPattern\Facade\Facade;
//开幕
(new Facade)->start();

//闭幕
(new Facade)->close();