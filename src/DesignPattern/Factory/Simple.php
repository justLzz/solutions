<?php

namespace Justlzz\Solutions\DesignPattern\Factory;

class Simple
{
    public function tool($toolName)
    {
        switch ($toolName) {
            case 'Hammer':
                $tool = new Hammer();
                break;
            case 'Pliers' :
                $tool = new Pliers();
                break;
            default :
                $tool = new Pliers();
        }
        return $tool;
    }
}