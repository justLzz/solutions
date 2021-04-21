## web服务器

### 网站502与504错误分析

一. 戏说
不管你是做运维还是做开发，哪怕你是游客，时不时会遇到502 Bad Gateway或504 Gateway Time-out。出现这页面，把服务重启下，再实在不行重启下服务器，问题就解决了，但是，这问题还是会困扰着你，特别是做运维的人员。夜黑风高正酣睡时，一个电话响起，让你重启服务或IISRESET，肯定是极大不爽，立马要问候他妈了。呵呵，本文总结502与504故障分析与解决方法。

二. 状态码解释
502 Bad Gateway：作为网关或者代理工作的服务器尝试执行请求时，从上游服务器接收到无效的响应。
504 Gateway Time-out：作为网关或者代理工作的服务器尝试执行请求时，未能及时从上游服务器（URI标识出的服务器，例如HTTP、FTP、LDAP）或者辅助服务器（例如DNS）收到响应。

三. 502 Bad Gateway原因分析
将请求提交给网关如php-fpm执行，但是由于某些原因没有执行完毕导致php-fpm进程终止执行。说到此，这个问题就很明了了，与网关服务如php-fpm的配置有关了。
php-fpm.conf配置文件中有两个参数就需要你考虑到，分别是max_children和request_terminate_timeout。
max_children最大子进程数，在高并发请求下，达到php-fpm最大响应数，后续的请求就会出现502错误的。可以通过netstat命令来查看当前连接数。
request_terminate_timeout设置单个请求的超时终止时间。还应该注意到php.ini中的max_execution_time参数。当请求终止时，也会出现502错误的。
当积累了大量的php请求，你重启php-fpm释放资源，但一两分钟不到，502又再次呈现，这是什么原因导致的呢？ 这时还应该考虑到数据库，查看下数据库进程是否有大量的locked进程，数据库死锁导致超时，前端终止了继续请求，但是SQL语句还在等待释放锁，这时就要重启数据库服务了或kill掉死锁SQL进程了。
对于长时间的请求可以考虑使用异步方式，可以参阅《关于PHP实现异步操作的研究》。

四. 504 Gateway Time-out原因分析
504错误一般是与nginx.conf配置有关了。主要与以下几个参数有关：fastcgi_connect_timeout、fastcgi_send_timeout、fastcgi_read_timeout、fastcgi_buffer_size、fastcgi_buffers、fastcgi_busy_buffers_size、fastcgi_temp_file_write_size、fastcgi_intercept_errors。特别是前三个超时时间。如果fastcgi缓冲区太小会导致fastcgi进程被挂起从而演变为504错误。

五. 小结
总而言之，502错误主要从四个方向入手：
1. max_children
2. request_terminate_timeout、max_execution_time
3. 数据库
4. 网关服务是否启动如php-fpm

504错误主要查看nginx.conf关于网关如fastcgi的配置。