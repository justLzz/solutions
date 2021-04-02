<?php


namespace Justlzz\Solutions\Config;


class Config implements ConfigInterface
{
    public $config;

    public function __construct($config = [])
    {
        $this->config = $config;
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


}