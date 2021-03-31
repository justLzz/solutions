<?php
require '/html/www/Solutions/autoloader.php';

use Solutions\Language\Php\Base\InteractiveFunction\CurlPost;

$post_data = array(
    "phone" => 13333333333,
    "city" => '北京',
    "name" => '小李',
    "ip" => '123.123.123.123'
);
$jsonStr = json_encode($post_data);
$email_url = 'http://127.0.0.1';

$post = new CurlPost();
$res = $post->setUrl($email_url)->setData($jsonStr)->send()->getResponse();
var_dump($res);

