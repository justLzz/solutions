<?php
require '../autoloader.php';
use Solutions\Amqp\Consumer;

function callback(AMQPEnvelope $message) {
    global $queue;
    if ($message) {
        $body = $message->getBody();
        echo '接收时间：'.date("Y-m-d H:i:s", time()). PHP_EOL;
        echo '接收内容：'.$body . PHP_EOL;
        //为了防止接收端在处理消息时down掉，只有在消息处理完成后才发送ack消息
        $queue->ack($message->getDeliveryTag());
    } else {
        echo 'no message' . PHP_EOL;
    }
}
$a = new Consumer();
$a->setExchangeType('x-delayed-message')
    ->setExchangeArguments(['x-delayed-type' => 'direct'])
    ->setQueueFlags(AMQP_DURABLE)
    ->init()
    ->consume('callback');