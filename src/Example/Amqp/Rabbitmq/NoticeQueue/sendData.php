<?php
require __DIR__ . "/../../../../../vendor/autoload.php";

use Justlzz\Solutions\Php\Base\InteractiveFunction\Curl;

//要发送的邮件的内容
$post_data = array(
    "phone" => 13333333333,
    "city" => '北京',
    "name" => '小李',
    "ip" => '123.123.123.123',
);

//邮件标题
$title = '您有一封新的邮件';

//邮件正文
$content = json_encode($post_data);

//要发送给的邮箱
$email = "1072084962@qq.com";

//发送服务的地址
$notice_url = 'http://127.0.0.1:9501';

$res = Curl::json(json_encode(['to'=>$email,'content'=>$content, 'title'=>$title]), $notice_url);
var_dump($res);

