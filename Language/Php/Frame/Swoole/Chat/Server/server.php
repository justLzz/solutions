<?php
require '/html/www/Solutions/autoloader.php';

use Solutions\Language\Php\Frame\Swoole\Chat\Server\WebSocketServer;

//创建server
$server = new WebSocketServer();