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
 
#### 
