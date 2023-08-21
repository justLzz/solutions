<?php

namespace Justlzz\Solutions\Php\High\DistributedId;

use Godruoyi\Snowflake\RedisSequenceResolver;


class Snowflake
{
    protected $datacenterId = 1; //数据中心id 1-31
    protected $workerId = 1; //机器id 1-31
    protected $startTimeStamp = 1692316800000; //开始时间2023-08-28
    public static function getId(\Redis $redis,
                                 $datacenterId = 1,
                                 $workerId = 1,
                                 $startTimeStamp = 1692316800000)
    {
        $snowflake = new \Godruoyi\Snowflake\Snowflake($datacenterId, $workerId);
        $snowflake->setStartTimeStamp($startTimeStamp);
        $sequenceResolver = new RedisSequenceResolver($redis);
        $snowflake->setSequenceResolver($sequenceResolver);
        return $snowflake->id();
    }
}