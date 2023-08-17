<?php


namespace Justlzz\Solutions\Php\Base\ApiInteraction;


interface ClientInterface
{

    /**
     * 设置主要数据
     * @param array $data
     * @return mixed
     */
    function setData(Array $data);

    /**
     * 获取请求数据
     * @return mixed
     */
    function getSendData();


}