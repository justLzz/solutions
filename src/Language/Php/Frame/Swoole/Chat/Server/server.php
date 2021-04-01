<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Language\Php\Frame\Swoole\Chat\Server\WebSocketServer;

//创建server
$server = new WebSocketServer();