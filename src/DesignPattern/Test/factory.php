<?php

require '/html/www/Solutions/autoloader.php';

use Solutions\DesignPattern\Factory\Simple;

$tool = (new Simple)->tool('Hammer');

$tool->use();