<?php
namespace Justlzz\Solutions\Amqp;

use Justlzz\Solutions\Amqp\Contracts\Share;

Class Consumer extends Share{

    public function consume(Callable $call) {
        $this->queue->consume($call);
    }

}