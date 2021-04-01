<?php
require '/html/www/Solutions/src/vendor/autoload.php';
use Justlzz\Solutions\Language\Php\Base\MagicMethods\__CallMethod;
use Justlzz\Solutions\Language\Php\Base\MagicMethods\__GetMethod;
use Justlzz\Solutions\Language\Php\Base\MagicMethods\__SetMethod;

//__call
$query = new __CallMethod();
$sql = $query->table('test')->field('id,title,des')->where("city='beijing'")->group('city')->order('id desc')->limit('0,9')->select();

//__get
$hello = new __GetMethod;
$name = $hello->name;
$say = $hello->say;
$nothing = $hello->nothing;

//__set
$people = new __SetMethod('晓明',44);
$people->echoPeople();
$people->name = 'wudi';
$people->age = 33;
$people->echoPeople();



