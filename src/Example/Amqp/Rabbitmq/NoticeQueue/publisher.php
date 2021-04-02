<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Amqp\Rabbitmq\NoticeQueue\NoticePublisher;
use Justlzz\Solutions\Config\Config;

$config = new Config('rabbitmq');
$config->set('exchangeName','notice-exchange');
$config->set('exchangeType','direct');
$config->set('queueName','notice-queue');
$config->set('queueFlags',[AMQP_DURABLE]);
$config->set('routeKey','notice-route');
$pub = new NoticePublisher($config);