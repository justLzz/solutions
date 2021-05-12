## 保证消息消费的顺序性
### RabbitMQ
```$xslt
拆分多个 queue，每个 queue 一个 consumer，就是多一些 queue 而已，确实是麻烦点；或者就一个 queue 但是对应一个 consumer，然后这个 consumer 内部用内存队列做排队，然后分发给底层不同的 worker 来处理。
```
![](.OrderLine_images/5e80ac72.png)