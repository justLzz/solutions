<?php
require '/html/www/Solutions/autoloader.php';

use Solutions\DesignPattern\Facade\Facade;
//开幕
(new Facade)->start();

//闭幕
(new Facade)->close();