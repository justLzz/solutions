<?php
require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Example\Database\Nosql\Redis\BloomFilter\Item;
use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Database\Nosql\Redis\Redis;

$config = new Config('redis');
$redis = Redis::getInstance($config);
$filter = new Item($redis);

$vs = ['qaz', 'wsx', 'edc', 'rfv', 'tgb'];

foreach ($vs as $v) $filter->add($v);

var_dump($filter->exists('qaz')); //true
var_dump($filter->exists('qwe')); //false


