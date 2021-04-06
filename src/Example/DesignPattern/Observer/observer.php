<?php

require '/html/www/Solutions/vendor/autoload.php';

use Justlzz\Solutions\DesignPattern\Observer\LoginNotice;
use Justlzz\Solutions\DesignPattern\Observer\Sms;
use Justlzz\Solutions\DesignPattern\Observer\Email;

$data = '用户13214登录成功';

$loginNotice = new LoginNotice();
$loginNotice->addObs(new Sms());
$loginNotice->addObs(new Email());
$loginNotice->setData($data);
$loginNotice->notice();
