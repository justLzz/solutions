<?php
namespace Justlzz\Solutions\Amqp\Contracts;

use Justlzz\Solutions\Config\ConfigInterface;

abstract class Share implements Common {

    public $config;

    public $connection;

    public $channel;

    public $exchange;

    public $queue;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config->toArray();
    }

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
}