<?php


namespace Justlzz\Solutions\Network\WebSocket\Swoole;

use Justlzz\Solutions\Database\Sql\Mysql\Mysql;

class Server
{
    public $server;
    public function __construct()
    {
        $this->server = new \Swoole\WebSocket\Server("0.0.0.0", 9501);
        $this->server->on('open', function (\Swoole\WebSocket\Server $server, $request) {
            echo "server: handshake success with fd{$request->fd}\n";
        });
        $this->server->on('message', function (\Swoole\WebSocket\Server $server, $frame) {
 //           echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
            $server->push($frame->fd, "已收到消息，正在获取用户信息...");
            $content = json_decode($frame->data,true);
            $rs = $this->dealContent((int)$content['content']);
            if (!empty($rs)) {
                foreach ($rs as $k=>$v)
                {
                    $server->push($frame->fd, $k . '：' . $v);
                }
            } else {
                $server->push($frame->fd, "用户不存在！");
            }
            $server->push($frame->fd, "处理完毕！");
        });
        $this->server->on('close', function ($ser, $fd) {
            echo "client {$fd} closed\n";
        });
        $this->server->on('request', function ($request, $response) {
            // 接收http请求从get获取message参数的值，给用户推送
            // $this->server->connections 遍历所有websocket连接用户的fd，给所有用户推送
            foreach ($this->server->connections as $fd) {
                // 需要先判断是否是正确的websocket连接，否则有可能会push失败
                if ($this->server->isEstablished($fd)) {
                    $this->server->push($fd, $request->get['message']);
                }
            }
        });
        $this->server->start();
    }

    public function dealContent(Int $content)
    {
        $user = [];
        if ($content)
        {
            $db = new Mysql();
            $user = $db->table('test')->where('id','=',$content)->first();
        }
        return $user;
    }

}