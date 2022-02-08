<?php
require __DIR__ . "/../../../../../vendor/autoload.php";
use Justlzz\Solutions\Amqp\Publisher;
use Justlzz\Solutions\Config\Config;

$config = new Config('rabbitmq');
$config->set('exchangeName','delay-exchange-test');
$config->set('exchangeType','x-delayed-message');
$config->set('exchangeArguments',['x-delayed-type' => 'direct']);
$config->set('queueName','delay-queue-test');
$config->set('queueFlags',[AMQP_DURABLE]);
$config->set('routeKey','delay-route-test');


$a = new Publisher($config);
$a->init();

for($i=5;$i>0;$i--){
    //生成消息
    echo '发送时间：'.date("Y-m-d H:i:s", time()).PHP_EOL;
    echo 'i='.$i.'，延迟'.$i.'秒'.PHP_EOL;
    $message = json_encode(['order_id'=>time(),'i'=>$i]);
    $a->exchange->publish($message, 'delay-route-test', AMQP_NOPARAM, ['headers'=>['x-delay'=> 1000*$i]]);
    sleep(2);
}
$a->connection->disconnect();