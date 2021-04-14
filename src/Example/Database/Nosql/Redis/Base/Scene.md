## redis数据类型和使用场景

### string

- 多用于缓存
```$xslt
set key value
```

- 计数器
```$xslt
incr key
```

- seesion共享
- 分布式系统全局序列号（分库分表的主键可以使用此方法  批量生成id会提升性能）
```$xslt
incrby orderid 1000
```
注：incr默认自增1，incrby必须规定自增值

- setbit的位运算

场景: 1亿个用户, 每个用户 登陆/做任意操作 ,记为 今天活跃,否则记为不活跃

### hash类型
[对象存储]
```$xslt
hset key field value field value
hget key field
hmget key field field
```
[购物车数据存储]
```$xslt
以用户id为key

以商品id为field

商品数量为value 购物车操作流程

添加商品 hset cart:123 10010 1（123为user_id   10010为商品id）

增加数量 hincrby cart:123 10010 1

商品总数 hlen cart:123

删除商品 hdel cart:123 10010

获取购物车所有商品  hgetall cart:123
```
###set
[点赞]
```$xslt
msg_id为朋友圈id   user_id为点赞操作的用户的id
点赞：sadd like:{msg_id} {user_id}
取消点赞：srem like:{msg_id} {user_id}
检查用户是否点过赞 : sismember like:{msg_id} {user_id}
获取点赞用户列表: smembers like:{msg_id}
获取点赞用户数: scard like:{msg_id}
```
[可以做一些简单的推荐]

用交集 差集等功能，做一些比较简单的推荐
```$xslt
sinter
sunion
sdiff
```

### zset
[实现新闻排行榜]
```$xslt
点击新闻     zincrby  news:date 1 news_id
展示当日排行前10   zrevrange news:date 0 9  withscores
展示7天排行榜
datalist为7天的日期  逐个枚举
zunionstore news:datelist  7  news:date1  news:date2  。。。。news:date7
展示7日排行前10
ZRANGE news:datelist 0 9 WITHSCORES
```




























