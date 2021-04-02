<?php
require '/html/www/Solutions/vendor/autoload.php';
use Justlzz\Solutions\Amqp\Publisher;

$a = new Publisher();
$a->setExchangeName('delay-exchange-test')
    ->setExchangeType('x-delayed-message')
    ->setExchangeArguments(['x-delayed-type' => 'direct'])
    ->setQueueName('delay-queue-test')
    ->setQueueFlags([AMQP_DURABLE])
    ->setRouteKey('delay-route-test')
    ->init();

for($i=5;$i>0;$i--){
    //生成消息
    echo '发送时间：'.date("Y-m-d H:i:s", time()).PHP_EOL;
    echo 'i='.$i.'，延迟'.$i.'秒'.PHP_EOL;
    $message = json_encode(['order_id'=>time(),'i'=>$i]);
    $a->exchange->publish($message, 'delay-route-test', AMQP_NOPARAM, ['headers'=>['x-delay'=> 1000*$i]]);
    sleep(2);
}
$a->connection->disconnect();