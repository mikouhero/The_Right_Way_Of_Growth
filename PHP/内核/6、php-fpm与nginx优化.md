# php-fpm 与nginx 优化


### 进程数

pm = static/dynamic,标识fpm 子进程的产生模式

static(静态)：表示fpm允运行时直接fork 出pm.max_children 个worker 进程

dynamic(动态)：表示运行时fork 出start_servers 个进程，随着负载的情况，动态的调整 ，最多不超过 max_spare_servers 个 进程

`一般推荐用static，优点是不用动态的判断负载情况，提升性能，缺点是多占用些系统内存资源。`

### max_children
- 这个值原则上越大越好，php-cgi 的进程多了就会处理的很快，排队的请求就会很少
- 设置max_children 也需要根据服务器的性能进行设定
- 一般来说一台服务器正常情况下每一个php-cgi所消耗的内存在20M 左右
- 假设“max_children”设置成100个，20M*100=2000M ，也就是说在峰值的时候所有PHP-CGI所耗内存在2000M以内。
- 假设“max_children”设置的较小，比如5-10个，那么php-cgi就会“很累”，处理速度也很慢，等待的时间也较长。 如果长时间没有得到处理的请求就会出现504 Gateway Time-out这个错误，而正在处理的很累的那几个php-cgi如果遇到了问题就会出现502 Bad gateway这个错误。

### start_servers
- pm.start_servers 的默认值是2 ，并且在php-fpm 中给的计算方式为： {（cpu空闲时等待连接的php的最小子进程数） + （cpu空闲时等待连接的php的最大子进程数 - cpu空闲时等待连接的php的最小子进程数）/ 2}；
- {（cpu空闲时等待连接的php的最小子进程数） + （cpu空闲时等待连接的php的最大子进程数 - cpu空闲时等待连接的php的最小子进程数）/ 2}；
- `一般而言，设置成10-20之间的数据足够满足需求了`


### 最大请求数max_requests

> 最大处理请求数是指一个php-fpm的worker进程在处理多少个请求后就终止掉，master进程会重新respawn一个新的。
这个配置的主要目的是避免php解释器或程序引用的第三方库造成的内存泄露。
pm.max_requests = 10240

-  当一个PHP-CGI 进程处理的请求数累积到max_requests 个后，自动重启该进程
- 502 是后端php-fpm不可用造成的，间歇性的502一般是由于php-fpm进程重启造成的
- 为什么要重启进程呢？
- 如果不定期重启 PHP-CGI 进程，势必造成内存使用量不断增长（比如第三方库有问题等）。因此 PHP-FPM 作为 PHP-CGI 的管理器，提供了这么一项监控功能，对请求达到指定次数的 PHP-CGI 进程进行重启，保证内存使用量不增长。
- 正是因为这个机制，在高并发中，经常导致 502 错误
- 目前我们解决方案是把这个值尽量设置大些，减少 PHP-CGI 重新 SPAWN 的次数，同时也能提高总体性能。PS：刚开始我们是500导致内存飙高，现在改成5120，当然可以再大一些，10240等，这个主要看测试结果，如果没有内存泄漏等问题，可以再大一些。

### 最长执行时间request_terminate_timeout
- 设置单个请求的超时中止时间. 该选项可能会对php.ini设置中的’max_execution_time’因为某些特殊原因没有中止运行的脚本有用. 设置为 ‘0’ 表示 ‘Off’.当经常出现502错误时可以尝试更改此选项。

- 这两项都是用来配置一个PHP脚本的最大执行时间的。当超过这个时间时，PHP-FPM不只会终止脚本的执行，还会终止执行脚本的Worker进程。
- Nginx会发现与自己通信的连接断掉了，就会返回给客户端502错误。

[相关文档](https://www.kancloud.cn/digest/php-src/136260)


### 502 504 错误产生以及解决方法


- 502 表示网关错误，当 PHP-CGI 得到一个无效响应，网关就会输出这个错误

> - php.ini 的 memory_limit 过小 
> - php-fpm.conf 中 max_children、max_requests 设置不合理  
> - php-fpm.conf 中 request_terminate_timeout、max_execution_time 设置不合理   
> - php-fpm 进程处理不过来，进程数不足、脚本存在性能问题  

- 504 表示网关超时，PHP-CGI 没有在指定时间响应请求，网关将输出这个错误

> Nginx+PHP 架构，可以调整 FastCGI 超时时间，fastcgi_connect_timeout、fastcgi_send_timeout、fastcgi_read_timeout
