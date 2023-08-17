<?php


namespace Justlzz\Solutions\Php\Base\InteractiveFunction;


class Curl
{
    public static function json(String $data, String $url, String $method = 'POST',
                                Array $headers = ['Content-Type:application/json'],
                                Int $timeout = 60 )
    {
        $handler = curl_init();
        curl_setopt($handler, CURLOPT_HEADER, 0);
        curl_setopt($handler, CURLOPT_URL, $url);
        curl_setopt($handler,CURLOPT_HTTPHEADER,$headers);
        if ($method == 'POST') {
            curl_setopt($handler,CURLOPT_POST,1);
            curl_setopt($handler,CURLOPT_POSTFIELDS,$data);
        }
        curl_setopt($handler,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($handler, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($handler, CURLOPT_SSL_VERIFYHOST, 0);
        $result=curl_exec($handler);
        $errNo = curl_errno($handler);
        if($errNo) {
            $errMsg = curl_error($handler);
            curl_close($handler);
            return ['code' => 1, 'message' => "CurlFalse：errorNo[{$errNo}]，errMsg[{$errMsg}]"];
        }
        curl_close($handler);
        return ['code' => 0, 'data' => json_decode($result, true)];
    }


}