<?php
require './autoloader.php';
use Solutions\Amqp\Rabbitmq\DelayQueue\OrderDelayRemove\Consumer;

$a = new Consumer();

$a->A();