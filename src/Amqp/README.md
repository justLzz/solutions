## amqp高级消息队列名词解释
- Producer：消息生产者。
- Consumer：消息消费者。
- Connection（连接）：Producer 和 Consumer 通过TCP 连接到 RabbitMQ Server。
- Channel（信道）：基于 Connection 创建，数据流动都是在 Channel 中进行。
- Exchange（交换器）：生产者将消息发送到 Exchange（交换器），由 Exchange 将消息路由到一个或多个 Queue 中（或者丢弃）；Exchange 并不存储消息；Exchange Types 常用有 Fanout、Direct、Topic 三种类型，每种类型对应不同的路由规则。
Queue（队列）：是 RabbitMQ 的内部对象，用于存储消息；消息消费者就是通过订阅队列来获取消息的，RabbitMQ 中的消息都只能存储在 Queue 中，生产者生产消息并最终投递到 Queue 中，消费者可以从 Queue 中获取消息并消费；多个消费者可以订阅同一个 Queue，这时 Queue 中的消息会被平均分摊给多个消费者进行处理，而不是每个消费者都收到所有的消息并处理。
- Binding（绑定）：是 Exchange（交换器）将消息路由给 Queue 所需遵循的规则。
- Routing Key（路由键）：消息发送给 Exchange（交换器）时，消息将拥有一个路由键（默认为空）， Exchange（交换器）根据这个路由键将消息发送到匹配的队列中。
- Binding Key（绑定键）：指定当前 Exchange（交换器）下，什么样的 Routing Key（路由键）会被下派到当前绑定的 Queue 中
- Direct：完全匹配，消息路由到那些 Routing Key 与 Binding Key 完全匹配的 Queue 中。比如 Routing Key 为cleint-key，只会转发cleint-key，不会转发cleint-key.1，也不会转发cleint-key.1.2。
- Topic：模式匹配，Exchange 会把消息发送到一个或者多个满足通配符规则的 routing-key 的 Queue。其中*表号匹配一个 word，#匹配多个 word 和路径，路径之间通过.隔开。如满足a.*.c的 routing-key 有a.hello.c；满足#.hello的 routing-key 有a.b.c.helo。
- Fanout：忽略匹配，把所有发送到该 Exchange 的消息路由到所有与它绑定 的Queue 中。
