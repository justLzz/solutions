<?php


namespace Justlzz\Solutions\Database\Contracts;

use Justlzz\Solutions\Config\Config;

/**
 * 数据库通用接口
 * Interface Common
 * @package Solutions\Database
 */
interface Common
{
    public static function getInstance(Config $config);
}