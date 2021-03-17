<?php
require '/html/www/Solutions/autoloader.php';

use Solutions\DesignPattern\Di\Reflection\Circle;
use Solutions\DesignPattern\Di\Reflection\Di;

//$reflectionClass =  new reflectionClass(Circle::class);
//
////获取常量
//$reflectionClass->getConstants();
//
////获取属性
//$reflectionClass->getProperties();
//
////获取方法
//$reflectionClass->getMethods();
//
////获取构造方法
//$constructor = $reflectionClass->getConstructor();
//
////获取构造方法参数
//$constructor->getParameters();

$di = new Di;
$c = $di->make(Circle::class);
var_dump($c->area());