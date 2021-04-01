<?php
require '/html/www/Solutions/src/vendor/autoload.php';

use Justlzz\Solutions\Database\Sql\Mysql\Mysql;

//分别开两个客户端运行两个脚本
$mysql = new Mysql();
//事务提交之前，这一行被锁住，其他脚本无法操作这一行
$res = $mysql->table('test')->where('id','=',1280026)->update(['uuid'=>123123, 'name'=>2222]);
var_dump($res);