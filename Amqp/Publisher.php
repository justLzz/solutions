<?php
namespace Solutions\Amqp;

use Solutions\Amqp\Contracts\Share;

Class Publisher extends Share{

    public function publish(Callable $call) {
        $this->exchange->publish();
    }

}

