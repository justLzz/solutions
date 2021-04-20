<?php


namespace Justlzz\Solutions\Amqp\Rabbitmq\NoticeQueue;

use Justlzz\Solutions\Amqp\Consumer;
use AMQPEnvelope;
use Justlzz\Solutions\Config\ConfigInterface;
use Justlzz\Solutions\Language\Php\Base\ToolFunction\Notice\NoticeInterface;

class NoticeConsumer
{
    protected $config;
    public function __construct(ConfigInterface $config,NoticeInterface $notice)
    {
        $this->config = $config->toArray();
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
        } else {
            //重新放回队列,容易造成死循环
            //$consumer->queue->nack($message->getDeliveryTag());
            //将data记录到日志或者数据表中，通过补偿措施进行消费
            $consumer->queue->ack($message->getDeliveryTag());
            $this->compensate($body);
        }
    }

    public function sendEmail($data, NoticeInterface $notice)
    {
        $arrayData = json_decode($data,true);
        if (!isset($arrayData['to'])) return false;
        $notice->clearAll();
        $res = $notice->to($arrayData['to'])
                    ->emailTitle($arrayData['title'])
                    ->emailContent($arrayData['content'])
                    ->send();
        return $res;
    }

    public function compensate($data)
    {
        error_log($data,3,$this->config['consumer_compensate_log_path']);
    }

}