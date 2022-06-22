<?php


namespace Justlzz\Solutions\Language\Php\Base\ApiInteraction;


interface ServiceInterface
{

    /**
     * 设置允许间隔时间单位s
     * @param $time
     * @return mixed
     */
    function setAllowTimeSpace($time);

    /**
     * 验签
     * @param $data
     * @return bool
     */
    function validateSign($data) : bool;


}