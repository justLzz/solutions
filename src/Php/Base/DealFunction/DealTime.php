<?php


namespace Justlzz\Solutions\Language\Php\Base\DealFunction;


class DealTime
{
    /**
     * Notes:获取微秒数
     * @return float
     */
    public static function msectime()
    {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }

    /**
     * Notes:获取前多少天时间的数组
     * @param $num
     * @return array
     * @throws \Exception
     */
    public static function getBeforeTimeArray($num) : array
    {
        if ($num < 1) throw new \Exception('rang of time is error');
        $timeArray = [];
        for ($i=0; $i<$num; $i++)
        {
            $time = date('Y-m-d', strtotime("-$i days"));
            array_push($timeArray, $time);
        }
        return $timeArray;
    }
}