<?php
require __DIR__ . "/../../../../../../vendor/autoload.php";
use Justlzz\Solutions\Php\Frame\Laravel\Middleware\VerifyCSRFToken;
use Justlzz\Solutions\Php\Frame\Laravel\Middleware\SetCookie;
use Justlzz\Solutions\Php\Frame\Laravel\Middleware\VerifyAuth;

//理解两个函数的作用call_user_func, array_reduce
//call_user_func ( callable $callback , mixed $parameter = ? , mixed $... = ? ) : mixed
//第一个参数 callback 是被调用的回调函数，其余参数是回调函数的参数。返回值:返回回调函数的返回值。

//array_reduce ( array $array , callable $callback( mixed $carry , mixed $item ) , mixed $initial = null ) : mixed
//参数：
//carry
//携带上次迭代的返回值； 如果本次迭代是第一次，那么这个值是 initial。
//item
//携带了本次迭代的值。
//initial
//如果指定了可选参数 initial，该参数将用作处理开始时的初始值，如果数组为空，则会作为最终结果返回。
//返回值：
//返回结果值。如果数组为空，并且没有指定 initial 参数，array_reduce() 返回 null。

//声明一个函数，回调函数可能是匿名函数，也可能不是
//function rrr ($a, $b, $c) {
//    return $a+$b+$c;
//};
//
//$c = function ($a, $b, $c) {
//    return $a+$b+$c;
//};
//$d = function ($e,$f) {
//    var_dump($e);
//    return $e . $f;
//};
////var_dump(call_user_func($a,1,2,3));
////var_dump(call_user_func("rrr",1,2,3));
//$b = [1,2,3];
//array_reduce($b,$d);

$handleNow = function () {
    echo "当前执行的程序" . PHP_EOL;
};

$pipeArr = [
    VerifyAuth::class,
    VerifyCSRFToken::class,
    SetCookie::class,
];

$callback = array_reduce($pipeArr,function ($stack, $pipe) {
    return function () use ($stack, $pipe) {
        return $pipe::handler($stack);
    };
}, $handleNow);
call_user_func($callback);