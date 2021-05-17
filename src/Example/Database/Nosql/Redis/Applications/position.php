<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Database\Nosql\Redis\Redis;
use Justlzz\Solutions\Database\Nosql\Redis\Application\Position;

$positions = [
    ['beijing', 116.28, 39.55],
    ['tianjin', 117.12, 39.08],
    ['shijiazhuang', 114.29, 38.02],
    ['tangshan', 118.01, 39.38],
    ['baoding', 115.29, 38.51]
];

$config = new Config('redis');
$redis = Redis::getInstance($config);
$position = new Position($redis);

//$position->addMultiplePosition($positions);//添加位置
//$position->getPosition(['beijing']);//获取位置
//$position->positionDistance('beijing', 'tianjin');//获取两个地点距离
//$position->positionRadiusByMember('beijing', '100');//获取某个成员半径范围内的成员

