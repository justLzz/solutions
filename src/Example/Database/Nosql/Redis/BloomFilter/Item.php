<?php

namespace Justlzz\Solutions\Example\Database\Nosql\Redis\BloomFilter;

use Justlzz\Solutions\Database\Nosql\Redis\BloomFilter\BloomFilter;
/**
 * 重复内容过滤器
 * 该布隆过滤器总位数为2^32位, 判断条数为2^30条. hash函数最优为3个.(能够容忍最多的hash函数个数)
 * 使用的三个hash函数为
 * BKDR, SDBM, JSHash
 *
 * 注意, 在存储的数据量到2^30条时候, 误判率会急剧增加, 因此需要定时判断过滤器中的位为1的的数量是否超过50%, 超过则需要清空.
 */
class Item extends BloomFilter
{
    /**
     * 表示判断重复内容的过滤器
     * @var string
     */
    protected $bucket = 'rptc';

    protected $hashFunction = array('BKDRHash', 'SDBMHash', 'JSHash');
}