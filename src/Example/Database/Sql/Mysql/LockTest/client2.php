<?php
require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Database\Sql\Mysql\Mysql;
use Justlzz\Solutions\Config\Config;

$config = new Config('mysql','/html/www/Solutions/src/Config');
//分别开两个客户端运行两个脚本
$mysql = new Mysql($config);

//事务提交之前，这一行被锁住，其他脚本无法操作这一行
$res = $mysql->table('test')->where('id','=',12)->update(['name'=>'33333']);
var_dump($res);