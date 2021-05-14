<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Amqp\Rabbitmq\AsyncConfirm\Publisher;


//mq配置
$mqConfig = new Config('rabbitmq');
$mqConfig->set('exchangeName','notice-exchange');
$mqConfig->set('exchangeType','direct');
$mqConfig->set('queueName','notice-queue');
$mqConfig->set('queueFlags',[AMQP_DURABLE]);
$mqConfig->set('routeKey','notice-route');

$pub = new Publisher($mqConfig);
$pub->init();
$message = 2;
for ($i=0;$i<50;$i++)
{
    $pub->exchange->publish($i, 'notice-route', AMQP_NOPARAM);
}

$pub->channel->waitForConfirm(5);
