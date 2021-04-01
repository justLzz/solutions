<?php


namespace Solutions\Amqp\Rabbitmq\NoticeQueue;

use Solutions\Amqp\Publisher;
use Solutions\Server\HttpServer\SwooleHttpServer;

/**
 * 用的是swoole提供的http服务
 * Class NoticePublisher
 * @package Solutions\Amqp\Rabbitmq\NoticeQueue
 */
class NoticePublisher extends SwooleHttpServer
{
    public $mqHandler;

    public function __construct()
    {
        $this->initPublisher();
        parent::__construct();
    }

    public function initPublisher()
    {
        $this->mqHandler = new Publisher();
        $this->mqHandler
            ->setExchangeName('notice-exchange')
            ->setExchangeType('direct')
            ->setQueueName('notice-queue')
            ->setQueueFlags([AMQP_DURABLE])
            ->setRouteKey('notice-route')
            ->init();
    }


    public function dealData($data): bool
    {
        return $this->mqHandler->exchange->publish($data, 'notice-route', AMQP_NOPARAM);
    }
}