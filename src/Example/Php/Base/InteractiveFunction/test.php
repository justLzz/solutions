<?php
require __DIR__ . "/../../../../../vendor/autoload.php";

use Justlzz\Solutions\Php\Base\InteractiveFunction\Curl;

$data = [
    'code' => 'zuYsQHSqnhMfzh4rh3XK-QIjAnyl6wkMdnCXAMPTJ-Lmccj2aMAchs8KLJCcvQcsnvEBS6D7PS5vIoBaudtQrqr4RAkp9MusU29JfftqsYLyXohjZd3-8noanC8'
];

$url = 'http://localhost:86/user/info';

var_dump(Curl::json(json_encode($data), $url));