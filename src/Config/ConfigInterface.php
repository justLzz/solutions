<?php

namespace Justlzz\Solutions\Config;

interface ConfigInterface {

    public function mSet(Array $config);


    public function mGet(Array $config);


    public function set($key, $value);


    public function get($key);

    public function toArray();
}