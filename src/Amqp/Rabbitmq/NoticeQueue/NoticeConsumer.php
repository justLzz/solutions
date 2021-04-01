<?php


namespace Solutions\Amqp\Rabbitmq\NoticeQueue;

use Solutions\Amqp\Consumer;
use AMQPEnvelope;
class NoticeConsumer
{
    public function __construct()
    {
        $a = new Consumer();
        $a->setExchangeName('notice-exchange')
            ->setExchangeType('direct')
            ->setQueueName('notice-queue')
            ->setQueueFlags([AMQP_DURABLE])
            ->setRouteKey('notice-route')
            ->init()
            ->consume(function ($message) use ($a) {
                if ($message) {
                    $this->dealData($message,$a);
                }
            });
    }

    public function dealData(AMQPEnvelope $message,Consumer $consumer)
    {
        $body = $message->getBody();
        if ($this->sendEmail($body)) {
            //为了防止接收端在处理消息时down掉，只有在消息处理完成后才发送ack消息
            $consumer->queue->ack($message->getDeliveryTag());
        }
    }

    public function sendEmail($data)
    {
        var_dump($data);
        return true;
    }

}