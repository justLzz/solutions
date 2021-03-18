<?php


namespace Solutions\DesignPattern\Observer;


class Sms implements Obs
{
    public function send(AbstractNotice $abstractNotice)
    {
        $data = $abstractNotice->getData();

        echo '发送短信内容:'  . $data . PHP_EOL;
    }
}