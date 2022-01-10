<?php


namespace Justlzz\Solutions\Language\Php\Base\ApiInteraction;


abstract class ApiService implements ServiceInterface
{
    protected $timeSpace = 5;

    /**
     * @param $time
     * @return mixed
     */
    function setAllowTimeSpace($time)
    {
        $this->timeSpace = $time;
        return $this;
    }

    /**
     * @param $data
     * @return bool
     */
    function validateSign($data): bool
    {
        $signA  = $data['sign'];
        unset($data['sign']);
        ksort($data);
        $str = http_build_query($data);
        $key = $this->getAppSecret($data['appId']);
        $signB = md5($str . $key);
        if ($signA != $signB)
        {
            throw new \Exception("签名错误");
        }
        if ((time() - $data['time']) > $this->timeSpace)
        {
            throw new \Exception("请求时间错误");
        }
        return true;

    }

    abstract function getAppSecret($appId) : string ;
}