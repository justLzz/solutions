<?php


namespace Justlzz\Solutions\DesignPattern\Observer;


class Email implements Obs
{
    public function send(AbstractNotice $abstractNotice)
    {
        $data = $abstractNotice->getData();

        echo '发送邮件内容:'  . $data . PHP_EOL;
    }
}