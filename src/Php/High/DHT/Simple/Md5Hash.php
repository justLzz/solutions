<?php


namespace Justlzz\Solutions\Language\Php\High\DHT\Simple;


class Md5Hash implements HashAlgorithm
{


    /**
     * 返回8字节32位字符
     * @param $string
     * @return false|string
     */
    public function hash($string)
    {
        return substr(md5($string), 0, 8);
    }
}