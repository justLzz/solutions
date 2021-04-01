<?php


namespace Solutions\DesignPattern\Di\Reflection;

use Solutions\DesignPattern\Di\Reflection\Point;

class Circle
{
    public $radius;
    public $center;

    const PI = 3.14;

    public function __construct(Point $point, $radius = 1)
    {
        $this->center = $point;
        $this->radius = $radius;
    }

    public function printCenter()
    {
        printf('center coordinate is (%d, %d)', $this->center->x, $this->center->y);
    }

    public function area()
    {
        return self::PI * pow($this->radius, 2);
    }
}