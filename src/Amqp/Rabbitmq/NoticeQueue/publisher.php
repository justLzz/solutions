<?php
require '/html/www/Solutions/src/vendor/autoload.php';

use Justlzz\Solutions\Amqp\Rabbitmq\NoticeQueue\NoticePublisher;

$pub = new NoticePublisher();