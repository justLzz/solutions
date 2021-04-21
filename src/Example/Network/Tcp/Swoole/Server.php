<?php


namespace Justlzz\Solutions\Example\Network\Tcp\Swoole;

use Justlzz\Solutions\Network\Tcp\Swoole\Server as TcpServer;

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