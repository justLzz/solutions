<?php

require '/html/www/Solutions/autoloader.php';

use Solutions\DesignPattern\Observer\LoginNotice;
use Solutions\DesignPattern\Observer\Sms;
use Solutions\DesignPattern\Observer\Email;

$data = '用户13214登录成功';

$loginNotice = new LoginNotice();
$loginNotice->addObs(new Sms());
$loginNotice->addObs(new Email());
$loginNotice->setData($data);
$loginNotice->notice();
