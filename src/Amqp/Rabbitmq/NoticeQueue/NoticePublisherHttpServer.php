<?php


namespace Justlzz\Solutions\Amqp\Rabbitmq\NoticeQueue;

use Justlzz\Solutions\Config\ConfigInterface;
use Justlzz\Solutions\Network\Http\Swoole\Server as HttpServer;
use Justlzz\Solutions\Amqp\Publisher;

class NoticePublisherHttpServer extends HttpServer
{

    public $mqHandler;

    public function __construct(ConfigInterface $config,Publisher $publisher)
    {
        $this->mqHandler = $publisher;
        parent::__construct($config);
    }

    public function dealCallBack($request, $response)
    {
        $data = $request->getContent();
        if ($this->dealData($data))
        {
            return $response->end('ok');
        } else {
            return $response->end('error');
        }
    }

    public function dealData($data): bool
    {
        return $this->mqHandler->exchange->publish($data, $this->mqHandler->config['routeKey'], AMQP_NOPARAM);
    }
}