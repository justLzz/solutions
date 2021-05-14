## redis slow-log 日志
- 先进先出队列
- 固定长度
- 保存在内存

### redis 慢查询配置
- 查询配置
```$xslt
config get slowlog-max-len = 128
config get slowlog-log-slower-than = 10000
```
- 修改配置
1，修改配置文件并重启
2，动态修改
```$xslt
config set slowlog-max-len 128
config set slowlog-log-slower-than 10000
```
- 相关命令
```$xslt
slowlog get [n] 条数
slowlog len 
slowlog reset
```