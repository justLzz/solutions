<?php


namespace Justlzz\Solutions\DesignPattern\Strategy;


class Strategy
{
    public $strategy;

    public function getItem($className)
    {
        $class = new \ReflectionClass($className);
        $this->strategy = $class->newInstance();
        return $this;
    }

    public function fColor()
    {
        return $this->strategy->favoriteColor();
    }

    public function fClass()
    {
        return $this->strategy->favoriteClass();
    }
}