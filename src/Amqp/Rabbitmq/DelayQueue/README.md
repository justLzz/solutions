## 延迟队列适用以下场景：
- 订单在十分钟之内未支付则自动取消。
- 新创建的店铺，如果在十天内都没有上传过商品，则自动发送消息提醒。
- 账单在一周内未支付，则自动结算。
- 用户注册成功后，如果三天内没有登陆则进行短信提醒。
- 用户发起退款，如果三天内没有得到处理则通知相关运营人员。
- 预定会议后，需要在预定的时间点前十分钟通知各个与会人员参加会议。

### 首先安装rabbitmq延迟队列插件，3.5.8版本以上可用
- _ttl+死信队列方式实现暂不做介绍_
```
rabbitmq-plugins enable rabbitmq_delayed_message_exchange
```