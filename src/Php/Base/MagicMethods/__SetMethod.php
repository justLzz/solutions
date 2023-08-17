<?php


namespace Justlzz\Solutions\Php\Base\MagicMethods;


class __SetMethod
{
    private $name;
    private $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function __set($name, $value)
    {
        if (isset($this->$name))
        {
            $this->$name = $value;
        }
    }

    public function echoPeople()
    {
        echo $this->name . PHP_EOL . $this->age . PHP_EOL;
    }
}