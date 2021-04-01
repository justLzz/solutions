<?php
namespace Justlzz\Solutions\Amqp\Contracts;

abstract class Share implements Common {
    /*RabbitMQ常用的Exchange Type有三种：fanout、direct、topic。
        fanout:把所有发送到该Exchange的消息投递到所有与它绑定的队列中。
        direct:把消息投递到那些binding key与routing key完全匹配的队列中。
        topic:将消息路由到binding key与routing key模式匹配的队列中。*/
    protected $config = [
        'connection' => [
            'host' => '172.17.0.1',
            'vhost' => '/',
            'port' => 5672,
            'login' => 'admin',
            'password' => 'admin'
        ],
        'exchangeName' => 'test',
        'exchangeType' => 'fanout',
        'exchangeArguments' => [],
        'exchangeFlags' => [],
        'queueName' => 'test',
        'queueFlags' => [],
        'routeKey' => 'test'
    ];

    public $connection;

    public $channel;

    public $exchange;

    public $queue;

    public function init()
    {
        try {
            $this->connection = $this->setConnection();
            $this->channel = $this->setChannel();
            $this->exchange = $this->setExchange();
            $this->queue = $this->setQueue();
            return $this;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function setConnection()
    {
        $conn = new \AMQPConnection($this->config['connection']);
        $conn->connect();
        return $conn;
    }

    public function setChannel()
    {
        $chan = new \AMQPChannel($this->connection);
        return $chan;
    }

    public function setExchange()
    {
        $ex = new \AMQPExchange($this->channel);
        $ex->setName($this->config['exchangeName']);
        if ($this->config['exchangeType']) $ex->setType($this->config['exchangeType']);
        if (!empty($this->config['exchangeArguments'])) $ex->setArguments($this->config['exchangeArguments']);
        if (!empty($this->config['exchangeFlags'])) {
            foreach ($this->config['exchangeFlags'] as $item)
            {
                if (is_int($item)) $ex->setFlags($item);
            }
        }
        $ex->declareExchange();
        return $ex;
    }

    public function setQueue()
    {
        $queue = new \AMQPQueue($this->channel);
        $queue->setName($this->config['queueName']);
        if (!empty($this->config['queueFlags'])) {
            foreach ($this->config['queueFlags'] as $item)
            {
                if (is_int($item)) $queue->setFlags($item);
            }
        }
        $queue->declareQueue();
        $queue->bind($this->config['exchangeName'], $this->config['routeKey']);
        return $queue;
    }

    public function setExchangeName(String $name) {
        $this->config['exchangeName'] = $name;
        return $this;
    }
    function setExchangeType(String $type) {
        $this->config['exchangeType'] = $type;
        return $this;
    }
    function setExchangeArguments(Array $arguments) {
        $this->config['exchangeArguments'] = $arguments;
        return $this;
    }
    function setExchangeFlags(Array $flags) {
        $this->config['exchangeFlags'] = $flags;
        return $this;
    }
    function setQueueName(String $name) {
        $this->config['queueName'] = $name;
        return $this;
    }
    function setQueueFlags(Array $flags) {
        $this->config['queueFlags'] = $flags;
        return $this;
    }
    function setRouteKey(String $routeKey) {
        $this->config['routeKey'] = $routeKey;
        return $this;
    }
}