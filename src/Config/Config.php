<?php


namespace Justlzz\Solutions\Config;


class Config implements ConfigInterface
{
    public $config;

    /**
     * Config constructor.
     * @param $configName
     * @param $configPath
     */
    public function __construct($configName,$configPath = '')
    {
        $configFile = __DIR__ . DIRECTORY_SEPARATOR . $configName . '.php';
        if ($configPath) $configFile = $configPath . DIRECTORY_SEPARATOR . $configName . '.php';
        if (is_file($configFile)) $this->config = include_once $configFile;
    }


    public function set($key, $value)
    {
        $this->config[$key] = $value;
        return true;
    }

    public function get($key)
    {
        return $this->config[$key];
    }

    public function mGet($keys = [])
    {
        $res = [];
        foreach ($keys as $key)
        {
            if (isset($this->config[$key]))
            {
                $res[$key] = $this->config[$key];
            }
            return $res;
        }
    }

    public function mSet($array = [])
    {
        foreach ($array as $item=>$value)
        {
            $this->config[$item] = $value;
        }
        return true;
    }

    public function toArray()
    {
        return $this->config;
    }


}