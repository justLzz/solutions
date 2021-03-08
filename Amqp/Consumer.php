<?php
namespace Solutions\Amqp;

use Solutions\Amqp\Contracts\Share;

Class Consumer extends Share{

    public function consume(Callable $call) {
        $this->queue->consume($call);
    }

}