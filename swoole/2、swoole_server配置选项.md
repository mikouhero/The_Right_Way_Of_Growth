#  配置参数

> 实例化对象   
```php
  $server = new swoole_server(IP,PORT);
  
  $server->set(CONFIG);
```  
> CONFIG 是 一个数组  常用的参数如下

#### 1、worker_num
 `指定启动的worker进程数`  
 swoole是master-> n * worker的模式，开启的worker进程数越多，server负载能力越大，但是相应的server占有的内存也会更多。同时，当worker进程数过多时，进程间切换带来的系统开销也会更大。因此建议开启的worker进程数为cpu核数的1-4倍。  
 
#### 2、max_request 
`每个worker进程允许处理的最大任务数`
设置该值后，每个worker进程在处理完max_request个请求后就会自动重启。设置该值的主要目的是为了防止worker进程处理大量请求后可能引起的内存溢出。

#### 3、max_conn
`服务器允许维持的最大TCP连接数`  
设置此参数后，当服务器已有的连接数达到该值时，新的连接会被拒绝。另外，该参数的值不能超过操作系统ulimit -n的值，同时此值也不宜设置过大，因为swoole_server会一次性申请一大块内存用于存放每一个connection的信息。

#### 4、ipc_mode 
` 设置进程的通信方式`
>共有三种通信方式，参数如下：  
1 => 使用unix socket通信  
2 => 使用消息队列通信  
3 => 使用消息队列通信，并设置为争抢模式  

#### 5、dispatch_mode
`指定数据包分发策略` 
>说明：共有三种模式，参数如下：  
1 => 轮循模式，收到会轮循分配给每一个worker进程  
2 => 固定模式，根据连接的文件描述符分配worker。这样可以保证同一个连接发来的数据只会被同一个worker处理  
3 => 抢占模式，主进程会根据Worker的忙闲状态选择投递，只会投递给处于闲置状态的Worker  

#### 6、task_worker_num 
`服务器开启的task进程数`
设置此参数后，服务器会开启异步task功能。此时可以使用task方法投递异步任务。  
设置此参数后，必须要给swoole_server设置onTask/onFinish两个回调函数，否则启动服务器会报错。  

#### 7、task_max_request 
`每个task进程允许处理的最大任务数`

#### 8、task_ipc_mode  
`置task进程与worker进程之间通信的方式`

#### 9、daemonize 
`设置程序进入后台作为守护进程运行`
长时间运行的服务器端程序必须启用此项。如果不启用守护进程，当ssh终端退出后，程序将被终止运行。启用守护进程后，标准输入和输出会被重定向到 log_file，如果 log_file未设置，则所有输出会被丢弃。

#### 10、log_file
`指定日志文件` 
在swoole运行期发生的异常信息会记录到这个文件中。默认会打印到屏幕。注意log_file 不会自动切分文件，所以需要定期清理此文件。
    
 
