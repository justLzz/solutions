<?php
require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Example\Network\Tcp\Swoole\LongConnection\Client;
use Justlzz\Solutions\Config\Config;

$config = new Config('swoole_tcp');

$client = new Client($config);