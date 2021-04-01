<?php
namespace Justlzz\Solutions\Amqp;

use Justlzz\Solutions\Amqp\Contracts\Share;

Class Publisher extends Share{

    public function publish(Callable $call) {
        $this->exchange->publish();
    }

}

