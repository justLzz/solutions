<?php


namespace Solutions\DesignPattern\Strategy;


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
        $this->strategy->favoriteColor();
    }

    public function fClass()
    {
        $this->strategy->favoriteClass();
    }
}