<?php

require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Example\Database\Nosql\Redis\DelayQueue\Task;
use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Database\Nosql\Redis\Redis;

$config = new Config('redis');

$redis = Redis::getInstance($config);

$task = new Task($redis, $config, 'order_test');

$task->add('order1', time() + 2, ['id' => 11, 'sku_id' => 12]);

echo '任务加入时间：' . date('Y-m-d H:i:s') . PHP_EOL;