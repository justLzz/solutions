## mysql常用命令

- 查询连接
```$xslt
show full processlist;
```

- 查询事务中的锁的堵塞情况
```$xslt
select * from information_schema.innodb_locks;
SELECT * FROM information_schema.innodb_lock_waits;
```

