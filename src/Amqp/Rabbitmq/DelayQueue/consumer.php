<?php
require '/html/www/Solutions/vendor/autoload.php';
use Justlzz\Solutions\Amqp\Consumer;


$a = new Consumer();
$a->setExchangeName('delay-exchange-test')
    ->setExchangeType('x-delayed-message')
    ->setExchangeArguments(['x-delayed-type' => 'direct'])
    ->setQueueName('delay-queue-test')
    ->setQueueFlags([AMQP_DURABLE])
    ->setRouteKey('delay-route-test')
    ->init()
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

