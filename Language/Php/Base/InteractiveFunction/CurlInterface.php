<?php


namespace Solutions\Language\Php\Base\InteractiveFunction;


interface CurlInterface
{
    public function setUrl($url);
    public function send();
    public function getResponse();
    public function getHttpCode();
}