<?php


namespace Justlzz\Solutions\Example\Network\Tcp\Swoole\LongConnection;


use Justlzz\Solutions\Network\Tcp\Swoole\LongConnectClient;

class Client extends LongConnectClient
{
    public function getSendData()
    {
        return 'sendData' . PHP_EOL;
    }

    public function dealReceive($data)
    {
        echo $data;
    }
}