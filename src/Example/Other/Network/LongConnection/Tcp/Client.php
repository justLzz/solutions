<?php


namespace Justlzz\Solutions\Example\Other\Network\LongConnection\Tcp;


use Justlzz\Solutions\Client\Tcp\SwooleTcpLongConnectClient;

class Client extends SwooleTcpLongConnectClient
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