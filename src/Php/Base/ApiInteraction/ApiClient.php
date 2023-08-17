<?php


namespace Justlzz\Solutions\Php\Base\ApiInteraction;


class ApiClient implements ClientInterface
{
    /**
     * @var $appId
     */
    protected $appId;

    /**
     * @var $appSecret
     */
    protected $appSecret;

    /**
     * @var $data
     */
    protected $data;

    /**
     * @var $sendData
     */
    protected $sendData;

    public function __construct($appId, $appSecret)
    {
        if (empty($appId) || empty($appSecret)) throw new \Exception("appId或者appSecrete不能为空");
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->data['appId'] = $appId;
    }

    /**
     * @param array $data
     * @return mixed
     */
    function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return mixed
     */
    function getSendData()
    {
        $this->data['appId'] = $this->appId;
        $this->data['time'] = time();
        ksort($this->data);
        $str = http_build_query($this->data);
        $this->data['sign'] = md5($str . $this->appSecret);
        return $this->data;
    }
}