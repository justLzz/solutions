<?php


namespace Justlzz\Solutions\Example\Language\Php\Base\ApiInteraction;

use Justlzz\Solutions\Config\Config;
use Justlzz\Solutions\Language\Php\Base\ApiInteraction\ApiService;

class Service extends ApiService
{
    public function getAppSecret($appId): string
    {
        $config = new Config('apiInteraction');
        return $config->get('app_secret');
    }
}