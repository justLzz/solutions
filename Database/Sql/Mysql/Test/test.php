<?php
require '/html/www/Solutions/autoloader.php';

use Solutions\Database\Sql\Mysql\Mysql;

$mysql = new Mysql();

$res = $mysql->table('test')
                ->where('name','楼')
                ->field(['uuid'])->select();
var_dump($res);