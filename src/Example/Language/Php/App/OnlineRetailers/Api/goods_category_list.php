<?php
//商品分类列表
require __DIR__ . "/../../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Database\Sql\Mysql\Mysql;
use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Language\Php\Base\DealFunction\DealArray;

$config = new Config('mysql','/html/www/Solutions/src/Config');

try {
    $mysql = new Mysql($config);
    $goodCategory = $mysql->table('goods_category')->select();
    $dealRes = DealArray::recursionInfinite($goodCategory);
    var_dump($dealRes);
}catch (\Exception $exception)
{
    echo $exception->getMessage();
}