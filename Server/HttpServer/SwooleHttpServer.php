<?php


namespace Solutions\Server\HttpServer;

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

/**
 * swoole创建http服务
 * Class SwooleHttpServer
 * @package Solutions\Server\HttpServer
 */
abstract class SwooleHttpServer
{
    public function __construct()
    {
        $http = new Server('127.0.0.1', 9501);
        $http->on('Request', function (Request $request, Response $response) {
            $data = $request->getContent();
            if ($this->dealData($data))
            {
                $response->end('ok');
            }
            $response->end('error');

        });
        $http->start();
    }

    abstract public function dealData($data):bool ;
}