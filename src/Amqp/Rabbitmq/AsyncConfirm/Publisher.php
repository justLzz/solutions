<?php


namespace Justlzz\Solutions\Amqp\Rabbitmq\AsyncConfirm;

use Justlzz\Solutions\Amqp\Publisher as BasePublisher;

class Publisher extends BasePublisher
{
    public function setChannel()
    {
        $chan = new \AMQPChannel($this->connection);
        if ($this->config['publisher_confirm'])
        {
            $chan->confirmSelect();
            $chan->setConfirmCallback(function (int $delivery_tag, bool $multiple){
            },function (int $delivery_tag, bool $multiple, bool $requeue){
            });
        }
        return $chan;
    }
}