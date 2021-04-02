<?php


namespace Justlzz\Solutions\Amqp\Rabbitmq\NoticeQueue;

use Justlzz\Solutions\Amqp\Publisher;
use Justlzz\Solutions\Server\HttpServer\SwooleHttpServer;
use Justlzz\Solutions\Config\ConfigInterface;
/**
 * 用的是swoole提供的http服务
 * Class NoticePublisher
 * @package Solutions\Amqp\Rabbitmq\NoticeQueue
 */
class NoticePublisher extends SwooleHttpServer
{
    public $mqHandler;


    public function __construct(ConfigInterface $config)
    {
        $this->initPublisher($config);
        parent::__construct();
    }

    public function initPublisher($config)
    {
        $this->mqHandler = new Publisher($config);
        $this->mqHandler->init();
    }


    public function dealData($data): bool
    {
        return $this->mqHandler->exchange->publish($data, $this->mqHandler->config['routeKey'], AMQP_NOPARAM);
    }
}