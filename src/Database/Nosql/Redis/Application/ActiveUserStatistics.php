<?php


namespace Justlzz\Solutions\Database\Nosql\Redis\Application;

use Justlzz\Solutions\Php\Base\DealFunction\DealTime;
/**
 * 基于redis bitmap实现活用用户统计
 * Class ActiveUserStatistics
 * @package Justlzz\Solutions\Database\Nosql\Redis\Application
 */
class ActiveUserStatistics
{
    protected $redis;

    public function __construct(\Redis $redis)
    {
        $this->redis = $redis;
    }

    /**
     * Notes:设置今天活跃了的用户
     * @param $userId
     * @return int
     */
    public function setDayActiveUserRecord($userId)
    {
        return $this->redis->setBit(date('Y-m-d'), $userId, 1);
    }

    /**
     * Notes:统计近$num天活跃过的用户个数
     * @param int $num
     * @param string $destKey
     * @return int
     * @throws \Exception
     */
    public function rangeTimeActiveUserNum($num = 1, $destKey = 'activeRecord')
    {
        $timeArray = DealTime::getBeforeTimeArray($num);
        $this->redis->bitOp('or', $destKey, ...$timeArray);
        return $this->redis->bitCount($destKey);
    }

    /**
     * Notes:统计近$num天每天都活跃的用户个数
     * @param int $num
     * @param string $destKey
     * @return int
     * @throws \Exception
     */
    public function rangePerTimeActiveUserNum($num = 1, $destKey = 'activeRecord')
    {
        $timeArray = DealTime::getBeforeTimeArray($num);
        $this->redis->bitOp('and', $destKey, ...$timeArray);
        return $this->redis->bitCount($destKey);
    }

    /**
     * Notes:判断一个用户活跃状态
     * @param $userId
     * @param string $destKey
     * @return bool
     */
    public function activeStatus($userId, $destKey = 'activeRecord') : bool
    {
        if ($this->redis->getBit($destKey, $userId)) return true;
        return false;
    }


}