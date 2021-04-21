<?php


namespace Justlzz\Solutions\Network\Tcp\Swoole;

use Justlzz\Solutions\Config\ConfigInterface;
use Swoole\Server as SwooleServer;

abstract class Server
{

    protected $serverHandler;
    protected $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config->toArray();
        $this->serverHandler = new SwooleServer($this->config['host'],
                                            $this->config['port'],
                                            $this->config['mode'],
                                            $this->config['sockType']);

        $this->serverHandler->set($this->config['set']);

        $this->serverHandler->on('connect', function ($server, $fd) {
            $this->onConnect($server, $fd);
        });

        $this->serverHandler->on('receive', function ($server, $fd, $reactor_id, $data) {
            $this->onReceive($server, $fd, $reactor_id, $data);
        });

        $this->serverHandler->on('close', function ($server, $fd) {
           $this->onClose($server, $fd);
        });

        $this->serverHandler->start();
    }

    abstract public function onConnect($server, $fd);

    abstract public function onReceive($server, $fd, $reactor_id, $data);

    abstract public function onClose($server, $fd);
}