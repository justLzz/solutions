<?php
require '/html/www/Solutions/autoloader.php';

use Solutions\Amqp\Rabbitmq\NoticeQueue\NoticeConsumer;

var_dump(new NoticeConsumer());