<?php
require '/html/www/Solutions/vendor/autoload.php';
use Justlzz\Solutions\Amqp\Consumer;
use Justlzz\Solutions\Config\Config;

$config = new Config('rabbitmq');
$config->set('exchangeName','delay-exchange-test');
$config->set('exchangeType','x-delayed-message');
$config->set('exchangeArguments',['x-delayed-type' => 'direct']);
$config->set('queueName','delay-queue-test');
$config->set('queueFlags',[AMQP_DURABLE]);
$config->set('routeKey','delay-route-test');

$a = new Consumer($config);

$a->init()
    ->consume(function (AMQPEnvelope $message) use ($a) {
        if ($message) {
            $body = $message->getBody();
            echo '接收时间：'.date("Y-m-d H:i:s", time()). PHP_EOL;
            echo '接收内容：'.$body . PHP_EOL;
            //为了防止接收端在处理消息时down掉，只有在消息处理完成后才发送ack消息
            $a->queue->ack($message->getDeliveryTag());
        } else {
            echo 'no message' . PHP_EOL;
        }
    });

