<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Server\HttpServer\Swoole\WebSocketServer;

//创建server
$server = new WebSocketServer();