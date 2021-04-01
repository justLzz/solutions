<?php


namespace Justlzz\Solutions\DesignPattern\Observer;


class LoginNotice extends AbstractNotice
{

    public $data;

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

}