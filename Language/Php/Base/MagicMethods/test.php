<?php
//__call
require '/html/www/Solutions/autoloader.php';
use Solutions\Language\Php\Base\MagicMethods\__CallMethod;

$query = new __CallMethod();
$sql = $query->table('test')->field('id,title,des')->where("city='beijing'")->group('city')->order('id desc')->limit('0,9')->select();
var_dump($sql);
