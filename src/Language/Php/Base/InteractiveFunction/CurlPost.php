<?php


namespace Solutions\Language\Php\Base\InteractiveFunction;


class CurlPost implements CurlInterface
{
    public $url;
    public $handler;
    public $data;
    public $httpCode;
    public $response;


    public function __construct()
    {
        $this->handler = curl_init();
    }

    public function setData(String $data)
    {
        curl_setopt($this->handler, CURLOPT_HEADER, 0);
        curl_setopt($this->handler,CURLOPT_HTTPHEADER,array(
                'Content-Type:application/json;charset=utf-8',
                'Content-Length:'.strlen($data)
            )
        );
        curl_setopt($this->handler,CURLOPT_POST,1);
        curl_setopt($this->handler,CURLOPT_POSTFIELDS,$data);
        curl_setopt($this->handler,CURLOPT_RETURNTRANSFER,1);
        return $this;
    }

    public function setUrl($url)
    {
        curl_setopt($this->handler,CURLOPT_URL,$url);
        return $this;
    }

    public function send()
    {
        $response=curl_exec($this->handler);
        $httpCode=curl_getinfo($this->handler,CURLINFO_HTTP_CODE);
        curl_close($this->handler);
        $this->response = $response;
        $this->httpCode = $httpCode;
        return $this;
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function getResponse()
    {
        return $this->response;
    }


}