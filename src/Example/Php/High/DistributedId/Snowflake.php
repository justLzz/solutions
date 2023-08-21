<?php
require __DIR__ . "/../../../../../vendor/autoload.php";

use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Database\Nosql\Redis\Redis;
use Justlzz\Solutions\Php\High\DistributedId\Snowflake;

$config = new Config('redis');
$redis = Redis::getInstance($config);
$id = Snowflake::getId($redis);
var_dump(dechex($id));

