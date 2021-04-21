<?php


namespace Justlzz\Solutions\Example\Other\Network\LongConnection\Tcp;


use Justlzz\Solutions\Server\TcpServer\Swoole\TcpServer;

class Server extends TcpServer
{
    public function onConnect($server, $fd)
    {
        echo 'connect' . PHP_EOL;
    }

    public function onReceive($server, $fd, $reactor_id, $data)
    {
        echo $data;
        $server->send($fd, 'server has get data' . PHP_EOL);
    }

    public function onClose($server, $fd)
    {
        echo 'close' .PHP_EOL;
    }
}