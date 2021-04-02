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


        'routeKey' => 'test'
];
