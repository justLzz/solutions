<?php
spl_autoload_register(function ($class) {
    $prefix = 'Solutions\\';
    $base_dir = '\\data\\Solutions\\';
    $len = strlen($prefix);
    if (strncmp($prefix,  $class, $len) !== 0) return;//比较顶级命名空间是否相等
    $relative_class = substr($class, $len);//返回$len长度以后的类名
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require  $file;
});