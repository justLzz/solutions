<?php

require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Database\Nosql\Redis\Redis;
use Justlzz\Solutions\Database\Nosql\Redis\CurrentLimiting\SlidingWindow;

$workerId = $argv[1];

$config = new Config('redis');
$redis = Redis::getInstance($config);
$limit = new SlidingWindow($redis);

if ($limit->isLimit("uniq_scene", 10*1000, 5))
{
    echo $msg = '进程：' . $workerId . ' | 请求允许通过' . ' | 时间： ' . date('H:i:s') . PHP_EOL;
} else {
    echo $msg = '进程：' . $workerId . ' | 请求不允许通过' . ' | 时间： ' . date('H:i:s') . PHP_EOL;
}


