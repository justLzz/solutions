<?php


namespace Solutions\DesignPattern\Observer;


interface Obs
{
    public function send(AbstractNotice $abstractNotice);
}