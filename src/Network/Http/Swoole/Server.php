<?php


namespace Justlzz\Solutions\Network\Http\Swoole;

use Swoole\Http\Server as SwooleHttpServer;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Justlzz\Solutions\Config\ConfigInterface;

/**
 * swoole创建http服务
 * Class SwooleHttpServer
 * @package Solutions\Server\HttpServer
 */
abstract class Server
{
    public $config;
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config->toArray();
        $http = new SwooleHttpServer($this->config['host'], $this->config['port']);
        $http->on('Request', function (Request $request, Response $response) {
            return $this->dealCallBack($request, $response);
        });
        $http->start();
    }

    abstract public function dealCallBack($request, $response);
}