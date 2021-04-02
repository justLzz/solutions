<?php
require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\Amqp\Rabbitmq\NoticeQueue\NoticePublisher;

$pub = new NoticePublisher();