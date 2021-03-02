# Nginx与PHP的两种通信方式-unix socket和tcp socket

## unix socket 
 - 需要在nginx配置文件中填写php-fpm运行的pid文件地址。
```html
location ~ \.php$ {
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;;
    fastcgi_pass unix:/var/run/php5-fpm.sock;
    fastcgi_index index.php;
}
```

## tcp  socker
 
```html

location ~ \.php$ {
    include fastcgi_params;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;;
    fastcgi_pass 127.0.0.1:9000;
    fastcgi_index index.php;
}
```

![](../img/php-nginx.png)


> unix socket减少了不必要的tcp开销，而tcp需要经过loopback，还要申请临时端口和tcp相关资源。但是，unix socket高并发时候不稳定，连接数爆发时，会产生大量的长时缓存，在没有面向连接协议的支撑下，大数据包可能会直接出错不返回异常。tcp这样的面向连接的协议，多少可以保证通信的正确性和完整性。

如果是在同一台服务器上运行的nginx和php-fpm，并发量不超过1000，选择unix socket，因为是本地，可以避免一些检查操作(路由等)，因此更快，更轻。 如果面临高并发业务，我会选择使用更可靠的tcp socket，以负载均衡、内核优化等运维手段维持效率。


## 总结
Nginx与php-fpm通信有两种方式，一种是通过tcp socket和 unix socket。前者是通过ip:端口方式进行通信，后者是通过php启动生成的socket文件进行通信。因此tcp socket的方式可以将两者分布再不同的机器上，只要Nginx能够连接到php服务器的端口即可。后者的方式，是统一主机上进行通讯的方式，因此两者只能再同一台机器上面。 

### tcp socket和 unix socket两者的优缺点 
由于 Unix socket 不需要经过网络协议栈，不需要打包拆包、计算校验和、维护序号和应答等，只是将应用层数据从一个进程拷贝到另一个进程。所以其效率比 tcp socket 的方式要高，可减少不必要的 tcp 开销。不过，unix socket 高并发时不稳定，连接数爆发时，会产生大量的长时缓存，在没有面向连接协议的支撑下，大数据包可能会直接出错不返回异常。而 tcp 这样的面向连接的协议，可以更好的保证通信的正确性和完整性。

### 如何选择tcp socket与unix socket

由于tcp方式相对unix的方式，并发量更高，因此针对并发量高的项目，建议采用tcp方式，现在Nginx配置示例文件默认的也是tcp方式。   
使用unix方式，可以优化的点，就是将socket文件放在/dev/shm目录下面，大致的意思，就是该目录下面的文件是不是存储再硬盘中的，而是存储再内存中的。至于硬盘读取和内存读取，谁快谁慢，肯定是内存最快了[说明](https://www.linuxidc.com/Linux/2014-05/101818.htm)   
使用unix方式可以使用backlog，backlog的介绍[说明](https://blog.csdn.net/raintungli/article/details/37913765)