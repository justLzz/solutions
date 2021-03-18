<?php


namespace Solutions\DesignPattern\Observer;


abstract class AbstractNotice
{

    public $obs = [];

    public function addObs(Obs $obs)
    {
        $this->obs[] = $obs;
    }

    public function notice()
    {
        foreach ($this->obs as $ob)
        {
            $ob->send($this);
        }
    }

    abstract public function setData($data);

    abstract public function getData();
}