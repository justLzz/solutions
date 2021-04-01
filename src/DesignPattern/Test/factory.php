<?php

require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\DesignPattern\Factory\Simple;

$tool = (new Simple)->tool('Hammer');

$tool->use();