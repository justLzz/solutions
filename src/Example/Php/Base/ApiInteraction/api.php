<?php
require __DIR__ . "/../../../../../../vendor/autoload.php";

use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Language\Php\Base\ApiInteraction\ApiClient;
use Justlzz\Solutions\Example\Language\Php\Base\ApiInteraction\Service;

$config = new Config('apiInteraction');
$appId = $config->get('app_id');
$appSecret = $config->get('app_secret');

$client = new ApiClient($appId, $appSecret);
$data = [
    'userId' => '1002'
];


$data = $client->setData($data)->getSendData();

$server = new Service();
var_dump($server->validateSign($data));




