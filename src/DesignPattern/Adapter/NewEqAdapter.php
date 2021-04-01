<?php


namespace Justlzz\Solutions\DesignPattern\Adapter;


class NewEqAdapter  implements EqInterface
{
    public $eq;

    public function __construct(NewEqInterface $eq)
    {
        $this->eq = $eq;
    }

    public function on()
    {
        $this->eq->startUp();
    }

    public function off()
    {
        $this->eq->close();
    }
}