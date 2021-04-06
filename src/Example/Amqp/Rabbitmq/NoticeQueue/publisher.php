<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Amqp\Publisher;
use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Amqp\Rabbitmq\NoticeQueue\NoticePublisherHttpServer;

$mq_config = new Config('rabbitmq','/html/www/Solutions/src/Config');
$mq_config->set('exchangeName','notice-exchange');
$mq_config->set('exchangeType','direct');
$mq_config->set('queueName','notice-queue');
$mq_config->set('queueFlags',[AMQP_DURABLE]);
$mq_config->set('routeKey','notice-route');

$http_config = new Config('swoole_http','/html/www/Solutions/src/Config');

$pub = new Publisher($mq_config);
$pub->init();
$httpServer = new NoticePublisherHttpServer($http_config,$pub);
var_dump($httpServer);