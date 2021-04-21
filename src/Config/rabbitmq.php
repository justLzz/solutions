<?php

return [
        'connection' => [
            'host' => '172.17.0.1',
            'vhost' => '/',
            'port' => 5672,
            'login' => 'admin',
            'password' => 'admin'
        ],
        'exchangeName' => 'test',
        'exchangeType' => 'fanout',
        'exchangeArguments' => [],
        'exchangeFlags' => [],
        'queueName' => 'test',
        'queueFlags' => [],
        'routeKey' => 'test',
        //通知发送失败将消息记录日志，日志路径，或者记录到数据库，定时任务去处理
        'consumer_compensate_log_path' => '/data/www/consumer_compensate.log'
];
