<?php

use Swoole\Process\Pool;
use Swoole\Process;

//开一个swoole多进程管理器
$process = new Process(function (Process $process) {
    $execPath = '/html/www/Solutions/Database/Nosql/Redis/DistributedLock/Test/secondKill.php'; //脚本路径
    $logPath = './error.log'; //日志路径
    $processName = 'multiProcessTest'; //进程名称
    $workerNum = 20; //进程数量

    $process->name($processName);
    Co::set(['hook_flags'=>SWOOLE_HOOK_ALL]); //开启一键协程
    $pool = new Pool($workerNum, SWOOLE_IPC_NONE, 0, true);
    $pool->on("WorkerStart", function (Pool $pool, $workerId)use ( $logPath, $workerNum, $execPath) {
        //echo date("H:i:s") . "Worker#{$workerId} is started\n";
        $a = $pool->getProcess($workerId)->exec('/usr/local/bin/php',[$execPath, $workerId]);
    });
    $pool->on("WorkerStop", function ($pool, $workerId) {
        //echo date("H:i:s") . "Worker#{$workerId} is stopped\n";
    });

    $pool->start();
});

$process->start();
//$process::daemon();
Process::wait();
