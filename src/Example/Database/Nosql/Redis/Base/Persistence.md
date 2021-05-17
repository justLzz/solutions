## redis 持久化相关
### rdb


生成快照三种方式
- 1，save同步生成，会堵塞

![](.Persistence_images/2120635f.png)
- 2,bgsave异步生成， 不会堵塞

![](.Persistence_images/8129314d.png)
![](.Persistence_images/a9e171a7.png)
- 3,触发自动生成
修改配置文件

![](.Persistence_images/77441af4.png)
```$xslt
redis单核，利用多核需开启多个redis实例
```

### aof

- 1, always

![](.Persistence_images/e4a27c88.png)
- 2, everysec
![](.Persistence_images/d9089728.png)

- 3, no

![](.Persistence_images/870365dc.png)

#### aof重写

![](.Persistence_images/79cf80f5.png)
![](.Persistence_images/cd57b1e6.png)
![](.Persistence_images/2e7ca098.png)
![](.Persistence_images/b94a6509.png)
![](.Persistence_images/83552e53.png)
![](.Persistence_images/c8e99fae.png)
![](.Persistence_images/24980b9c.png)

![](.Persistence_images/b0f5ae1d.png)
![](.Persistence_images/1094d8fd.png)