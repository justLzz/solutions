<?php


namespace Justlzz\Solutions\Database\Nosql\Redis\Application;

/**
 * redis实现map相关操作
 * Class Map
 * @package Justlzz\Solutions\Database\Nosql\Redis\Application
 */
class Position
{
    protected $redis;

    /**
     * 位置信息合集的key
     * @var
     */
    protected $key = 'city';

    public function __construct(\Redis $redis)
    {
        $this->redis = $redis;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * Notes:添加一个位置
     * @param $member
     * @param $longitude
     * @param $latitude
     * @return int
     */
    public function addPosition($member, $longitude, $latitude)
    {
        return $this->redis->geoadd($this->key, $longitude, $latitude, $member);
    }

    /**
     * Notes:添加多个位置
     * @param $posArray
     * @return bool
     */
    public function addMultiplePosition($posArray)
    {
        foreach ($posArray as $position) {
            if (!$this->addPosition(...$position)) return false;
        }
        return true;
    }

    /**
     * Notes:获取一个或多个位置
     * @param array $member
     * @return array
     */
    public function getPosition(array $member)
    {
       return $this->redis->geopos($this->key, ...$member);
    }

    /**
     * Notes:获取两个位置间的距离
     * @param $member1
     * @param $member2
     * @param string $unit
     * @return float
     */
    public function positionDistance($member1, $member2, $unit = 'km')
    {
        return $this->redis->geodist($this->key, $member1, $member2, $unit);
    }

    /**
     * Notes:查询给定位置以及半径范围内位置
     * @param $longitude
     * @param $latitude
     * @param string $radius
     * @param string $unit
     * @param array $options
     * @return mixed
     */
    public function positionRadius($longitude, $latitude, $radius, $unit = 'km', $options = [])
    {
        return $this->redis->georadius($this->key, $longitude, $latitude, $radius, $unit, $options);
    }

    /**
     * Notes:查询某个成员位置半径范围内位置
     * @param $member
     * @param string $unit
     * @param string $radius
     * @param array $options
     * @return array
     */
    public function positionRadiusByMember($member, $radius, $unit = 'km', $options = [])
    {
        return $this->redis->georadiusbymember($this->key, $member, $radius, $unit, $options);
    }


}