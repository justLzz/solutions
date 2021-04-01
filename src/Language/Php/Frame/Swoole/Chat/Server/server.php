<?php
require '/html/www/Solutions/src/vendor/autoload.php';

use Justlzz\Solutions\Language\Php\Frame\Swoole\Chat\Server\WebSocketServer;

//创建server
$server = new WebSocketServer();