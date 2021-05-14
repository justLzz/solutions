## redis 基础知识
Redis中key的过期淘汰机制
Redis可以对存储在Redis中的缓存数据设置过期时间，比如我们获取的短信验证码一般十分钟过期，我们这时候就需要在验证码存进Redis时添加一个key的过期时间，但是这里有一个需要格外注意的问题就是：并非key过期时间到了就一定会被Redis给删除。那么Redis是如何做到对过期key进行删除呢？Redis中对于过期key的删除分为两种策略：定期删除和惰性删除。

定期删除：Redis 默认是每隔 100ms 就随机抽取一些设置了过期时间的 Key，检查其是否过期，如果过期就删除。为什么是随机抽取而不是检查所有key？因为你如果设置的key成千上万，每100毫秒都将所有存在的key检查一遍，会给CPU带来比较大的压力。

惰性删除 ：定期删除由于是随机抽取可能会导致很多过期 Key 到了过期时间并没有被删除。所以用户在从缓存获取数据的时候，redis会检查这个key是否过期了，如果过期就删除这个key。这时候就会在查询的时候将过期key从缓存中清除。

但是如果仅仅使用定期删除 + 惰性删除机制还是会留下一个严重的隐患：如果定期删除留下了很多已经过期的key，而且用户长时间都没有使用过这些过期key，导致过期key无法被惰性删除，从而导致过期key一直堆积在内存里，最终造成Redis内存块被消耗殆尽。那这个问题如何解决呢？这个时候Redis内存淘汰机制应运而生了。Redis内存淘汰机制提供了6种数据淘汰策略：

volatile-lru：从已设置过期时间的数据集中挑选最近最少使用的数据淘汰。

volatile-ttl：从已设置过期时间的数据集中挑选将要过期的数据淘汰。

volatile-random：从已设置过期时间的数据集中任意选择数据淘汰。

allkeys-lru：当内存不足以容纳新写入数据时移除最近最少使用的key。

allkeys-random：从数据集中任意选择数据淘汰。

no-enviction：当内存不足以容纳新写入数据时，新写入操作会报错。

一般情况下，推荐使用volatile-lru策略，对于配置信息等重要数据，不应该设置过期时间，这样Redis就永远不会淘汰这些重要数据。对于一般数据可以添加一个缓存时间，当数据失效则请求会从DB中获取并重新存入Redis中。

## redis pipeline
将多个命令打包为一次网络数据发送

## redis multi和redis pipeline
区别在于multi实在服务端缓冲命令，pipeline是在客户端缓冲不能保证原子性

## 发布订阅
publish subscribe

## bitmap 位图
```$xslt
setbit key offset value 设置位图
getbit key offset 获取位图
bitcount key [start end] 获取指定范围位值为1的个数
bitop op[and not or xor] destkey key[...key] 求交集（and）并集(or)非（not）异或(xor)
bitpos key targetBit [start end] 计算位图指定范围（单位为字节，如果不指定获取全部）第一个偏移量的值等于targetBit的位置
```
- 应用
活跃用户统计
#### 扩展
计算机存储容量的大小一般以（字节）为单位1GB=1024MB，1MB=1024KB，1KB=1024B，二个B（字节byte）存储一个汉字，一个B存储一个英文字母，一个256MB的U盘可以存储256*1024*1024/2个汉字。一个字节包括8个二进制位数。
### HyperLogLog
```$xslt
pfadd key element [element...] 向hyperloglog添加元素
pfcount key [key...] 计算hyperloglog独立总数
pfmerge destkey sourceKey
```
- 独立用户统计
