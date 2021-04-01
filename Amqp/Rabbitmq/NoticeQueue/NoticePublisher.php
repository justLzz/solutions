<?php


namespace Solutions\Amqp\Rabbitmq\NoticeQueue;

use Solutions\Amqp\Publisher;
use Solutions\Server\HttpServer\SwooleHttpServer;

class Publisher extends SwooleHttpServer
{
    public $mqHandler;

    public function __construct(Publisher $publisher)
    {
        parent::__construct();
        $this->mqHandler = $publisher;
    }

    public function dealData($data): bool
    {
        
    }
}