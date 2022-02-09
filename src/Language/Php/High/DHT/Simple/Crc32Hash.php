<?php


namespace Justlzz\Solutions\Language\Php\High\DHT\Simple;


class Crc32Hash implements HashAlgorithm
{

    public function hash($string)
    {
        return crc32($string);
    }
}