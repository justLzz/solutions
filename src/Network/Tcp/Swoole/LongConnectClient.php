<?php


namespace Justlzz\Solutions\Network\Tcp\Swoole;

use Justlzz\Solutions\Config\ConfigInterface as ServerConnectConfig;
use Swoole\Client;

abstract class LongConnectClient
{
    protected $client;

    protected $config;

    public function __construct(ServerConnectConfig $config)
    {
        $this->config = $config->toArray();
        $this->client = new Client($this->config['sockType']  | SWOOLE_KEEP);
        $this->client->connect($this->config['host'], $this->config['port'], $this->config['set']['heartbeat_check_interval']);
        $this->client->send($this->getSendData());
        $client = $this->client;
        //客户端发送心跳保持连接
        swoole_timer_tick($this->config['set']['heartbeat_idle_time'] * 1000,function () use($client){
            $client->send(pack('N', strlen('1')).'1');
        });
        $this->dealReceive($this->client->recv());
    }

    abstract public function getSendData();

    abstract public function dealReceive($data);

}