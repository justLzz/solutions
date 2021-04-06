<?php


namespace Justlzz\Solutions\Server\HttpServer\Swoole;

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Justlzz\Solutions\Config\ConfigInterface;

/**
 * swoole创建http服务
 * Class SwooleHttpServer
 * @package Solutions\Server\HttpServer
 */
abstract class HttpServer
{
    public $config;
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config->toArray();
        $http = new Server($this->config['host'], $this->config['port']);
        $http->on('Request', function (Request $request, Response $response) {
            return $this->dealCallBack($request, $response);
        });
        $http->start();
    }

    abstract public function dealCallBack($request, $response);
}