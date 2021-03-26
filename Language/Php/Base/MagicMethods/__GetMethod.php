<?php


namespace Solutions\Language\Php\Base\MagicMethods;


class __GetMethod
{
    private $name = '美女';
    private $say = '你好';

    public function __get($name)
    {
        if (isset($this->$name))
        {
            return $this->$name;
        }
        return '不存在哦';
    }
}