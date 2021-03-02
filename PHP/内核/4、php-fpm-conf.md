# 全局配置
[global]

## pid设置，pid进程文件存放的路径
pid = /usr/local/php/var/run/php-fpm.pid

## 错误日志存放路径
error_log = /usr/local/php/var/log/php-fpm.log

## 错误级别。默认: notice，可用级别为: 
alert（必须立即处理）  
error（错误情况）   
warning（警告情况）   
notice（一般重要信息）   
debug（调试信息）   
log_level = notice     

## emergency_restart_threshold
## emergency_restart_interval
## process_control_timeout

表示在emergency_restart_interval所设值内出现SIGSEGV或者SIGBUS错误的php-cgi进程数 如果超过emergency_restart_threshold个php-fpm就会优雅重启。这两个选项一般保持默认值。

>一分钟内出现10次上述信号即重启php-fpm   
emergency_restart_threshold 10  
emergency_restart_interval 60s  
超时时间设置，网上有建议使用php配置中的max_execution_time，觉得没必要。
process_control_timeout 10


## rlimit_files
设置文件打开描述符的rlimit限制. 默认值: 系统定义值
系统默认可打开句柄是1024，可使用 ulimit -n查看，ulimit -n 2048修改。
## rlimit_core
设置核心rlimit最大限制值. 可用值: ‘unlimited' 、0或者正整数. 默认值: 系统定义值.


# 进程池设置
[www]

## 监听设置，
即nginx中php处理的地址，一般默认值即可。可用格式为: 'ip:port', 'port', '/path/to/unix/socket'.   
listen = /tmp/php-cgi.sock  

## backlog数，
可以理解为TCP中的半连接数，-1表示无限制，由操作系统决定。
listen.backlog = -1

## 允许访问FastCGI进程的IP，
设置any为不限制IP，如果要设置其他主机的nginx也能访问这台FPM进程，listen处要设置成本地可被访问的IP。默认值是any。每个地址是用逗号分隔. 如果没有设置或者为空，则允许任何服务器请求连接  
listen.allowed_clients = 127.0.0.1

## 监听进程的用户
listen.owner = www

## 监听进程的组
listen.group = www

## 用socket连接方式时，指定拥有unix socket权限的用户，默认和运行的用户一样；用tcp连接可以注释掉
listen.mode = 0666

## 启动进程的用户
user = www

## 启动进程的组
group = www

## 选择进程池管理器如何控制子进程的数量，选项有static和dynamic。如果选择static，则由以下参数控制。
pm = dynamic

## 同一时刻最大存活子进程数
pm.max_children = 20
## 在启动时启动的子进程数量
pm.start_servers = 10
## 处于空闲"idle"状态的最小子进程，如果空闲进程数量小于这个值，那么相应的子进程会被创建
pm.min_spare_servers = 10
## 最大空闲子进程数量，空闲子进程数量超过这个值，那么相应的子进程会被杀掉。
pm.max_spare_servers = 20
## 终止请求超时时间，在worker进程被杀掉之后，提供单个请求的超时间隔。由于某种原因不停止脚本执行时，应该使用该选项，0表示关闭不启用
request_terminate_timeout = 100
## 慢日志请求超时时间，对一个php程序进行跟踪
request_slowlog_timeout = 0
## 慢请求日志
slowlog = var/log/slow.log
