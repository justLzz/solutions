<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Example\Other\Network\LongConnection\Tcp\Client;
use Justlzz\Solutions\Config\Config;

$config = new Config('swoole_tcp');

$client = new Client($config);