<?php


namespace Justlzz\Solutions\Amqp\Rabbitmq\NoticeQueue;

use Justlzz\Solutions\Amqp\Consumer;
use AMQPEnvelope;
use Justlzz\Solutions\Config\ConfigInterface;
use Justlzz\Solutions\Language\Php\Base\ToolFunction\Notice\NoticeInterface;

class NoticeConsumer
{
    public function __construct(ConfigInterface $config,NoticeInterface $notice)
    {
        $a = new Consumer($config);
        $a->init()->consume(function ($message) use ($a, $notice) {
                if ($message) {
                    $this->dealData($message,$a,$notice);
                }
            });
    }

    public function dealData(AMQPEnvelope $message,Consumer $consumer, NoticeInterface $notice)
    {
        $body = $message->getBody();
        if ($this->sendEmail($body, $notice)) {
            //为了防止接收端在处理消息时down掉，只有在消息处理完成后才发送ack消息
            $consumer->queue->ack($message->getDeliveryTag());
        }
    }

    public function sendEmail($data, NoticeInterface $notice)
    {
        $arrayData = json_decode($data,true);
        if (!isset($arrayData['to'])) return false;
        $res = $notice->to($arrayData['to'])
                    ->emailTitle($arrayData['title'])
                    ->emailContent($arrayData['content'])
                    ->send();
        return $res;
    }

}