<?php


namespace Justlzz\Solutions\Amqp\Rabbitmq\NoticeQueue;

use Justlzz\Solutions\Amqp\Consumer;
use AMQPEnvelope;
use Justlzz\Solutions\Language\Php\Base\ToolFunction\Email;

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

    /**
     * Notes:发送邮件
     * User: Admin
     * Date: 2021/4/1
     * Time: 16:07
     * @param $data
     * @return bool
     */
    public function sendEmail($data)
    {

        $email = new Email();
        $arrayData = json_decode($data,true);
        if (!isset($arrayData['to'])) return false;
        $content = $arrayData['data'];
        $res = $email->from('www@***.net', '云表单邮件通知')
                    ->to($arrayData['to'])
                    ->emailTitle('您有一封新的邮件')
                    ->emailContent($content)
                    ->send();
        return true;

    }

}