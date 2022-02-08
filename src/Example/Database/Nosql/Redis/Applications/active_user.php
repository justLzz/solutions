<?php
require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Database\Nosql\Redis\Redis;
use Justlzz\Solutions\Database\Nosql\Redis\Application\ActiveUserStatistics;

$config = new Config('redis');
$redis = Redis::getInstance($config);

//记录活跃用户
//新建伪数据
//for ($i=0; $i<10; $i++)
//{
//    $time = date('Y-m-d', strtotime("-$i days"));
//    $userIdArray = [1,62,37,8,162,895,71,2,49,18,15,121,812,47,198,9,2,46,17,82,46];
//    //每天随机14个活跃用户
//    $randKeys = array_rand($userIdArray, 14);
//    foreach ($randKeys as $key)
//    {
//        $redis->setBit($time, $userIdArray[$key], 1);
//    }
//}

//统计三天活跃每天都活跃用户个数
$active = new ActiveUserStatistics($redis);
//var_dump($active->rangePerTimeActiveUserNum(3));

//统计三天活跃过用户个数
//var_dump($active->rangeTimeActiveUserNum(3));

//获取某个用户是否是连续活跃3天
$active->rangeTimeActiveUserNum(3);
$userIdArray = [1,62,37,8,162,895,71,2,49,18,15,121,812,47,198,9,2,46,17,82,46];
$userId = $userIdArray[mt_rand(0,20)];
if ($active->activeStatus($userId))
{
    echo '用户' . $userId . '连续登陆3天' . PHP_EOL;
} else {
    echo '用户' . $userId . '没有连续登陆3天' . PHP_EOL;
}
