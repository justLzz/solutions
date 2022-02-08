<?php
require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Database\Nosql\Redis\Redis;
use Justlzz\Solutions\Database\Nosql\Redis\CurrentLimiting\StringIncrLimit;

$workerId = $argv[1];

$config = new Config('redis');
$redis = Redis::getInstance($config);
$limit = StringIncrLimit::getInstance($redis)->setLimitNum(5)->checkLimit();

if ($limit)
{
    echo $msg = '进程：' . $workerId . ' | 请求允许通过' . ' | 时间： ' . date('H:i:s') . PHP_EOL;
} else {
    echo $msg = '进程：' . $workerId . ' | 请求不允许通过' . ' | 时间： ' . date('H:i:s') . PHP_EOL;
}