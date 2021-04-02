<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Amqp\Rabbitmq\NoticeQueue\NoticeConsumer;
use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Language\Php\Base\ToolFunction\Notice\Email;


//mq配置
$mqConfig = new Config('rabbitmq');
$mqConfig->set('exchangeName','notice-exchange');
$mqConfig->set('exchangeType','direct');
$mqConfig->set('queueName','notice-queue');
$mqConfig->set('queueFlags',[AMQP_DURABLE]);
$mqConfig->set('routeKey','notice-route');

//邮件服务配置
$mailConfig = new Config('mail');
$email = new Email($mailConfig);
$email->from('www@yunbd.net', '云表单邮件通知')->emailTitle('您有一封新的邮件');

$consumer = new NoticeConsumer($mqConfig, $email);
