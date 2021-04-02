<?php
use Justlzz\Solutions\Config\Env;

return [
    'isSMTP' => true, // 使用SMTP服务
    'chartSet' => "utf8", // 编码格式为utf8，不设置编码的话，中文会出现乱码
    'host' => "smtp.mxhichina.com", // 发送方的SMTP服务器地址
    'SMTPAuth' => true, // 是否使用身份验证
    'username' => Env::get('email.username'), // 发送方的QQ邮箱用户名，就是自己的邮箱名
    'password' => Env::get('email.password'),// 发送方的邮箱密码，不是登录密码,是qq的第三方授权登录码,要自己去开启,
    'SMTPSecure' => "ssl",// 发送方的邮箱密码，不是登录密码,是qq的第三方授权登录码,要自己去开启,在邮箱的设置->账户->POP3/IMAP/SMTP/Exchange/CardDAV/CalDAV服务 里面
    'port' => 465
];