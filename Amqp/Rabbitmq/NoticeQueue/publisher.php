<?php
require '/html/www/Solutions/autoloader.php';

use Solutions\Amqp\Rabbitmq\NoticeQueue\NoticePublisher;

$pub = new NoticePublisher();