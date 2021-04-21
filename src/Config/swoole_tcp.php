<?php

return [
    'host' => '0.0.0.0',
    'port' => 18888,
    'mode' => SWOOLE_PROCESS,
    'sockType' => SWOOLE_SOCK_TCP,
    'set' => [
        'reactor_num' => swoole_cpu_num() * 4,
        'heartbeat_check_interval' => 5,//心跳检测
        'heartbeat_idle_time' => 10, //10秒客户端如果没有对服务端发送数据则关闭
    ]
];