# MySQL 常见优化方式   -  优化工具

### 数据库层面

#####   检查问题常用工具

```html
mysql
msyqladmin                                 mysql客户端，可进行管理操作
mysqlshow                                  功能强大的查看shell命令
show [SESSION | GLOBAL] variables          查看数据库参数信息
SHOW [SESSION | GLOBAL] STATUS             查看数据库的状态信息
information_schema                         获取元数据的方法
SHOW ENGINE INNODB STATUS                  Innodb引擎的所有状态
SHOW PROCESSLIST                           查看当前所有连接session状态
explain                                    获取查询语句的执行计划
show index                                 查看表的索引信息
slow-log                                   记录慢查询语句
mysqldumpslow                              分析slowlog文件的

```

不常用但好用的工具
```html
zabbix                  监控主机、系统、数据库（部署zabbix监控平台）
pt-query-digest         分析慢日志
mysqlslap               分析慢日志
sysbench                压力测试工具
mysql profiling         统计数据库整体状态工具    
Performance Schema      mysql性能状态统计的数据
workbench               管理、备份、监控、分析、优化工具（比较费资源）
```

##### 数据库层面问题解决思路

一般应急思路 针对突然的业务办理卡顿，无法进行正常的业务处理！需要立马解决的场景！   

    show processlist        
    explain select id ,name from stu where name=’clsn’; # ALL id name age sex       
    通过执行计划判断，索引问题（有没有、合不合理）或者语句本身问题     
    show status like ‘% lock%’; # 查询锁状态     
    kill SESSION_ID; # 杀掉有问题的 session     
    
常规调优思路：

针对业务周期性的卡顿，例如在每天 10-11 点业务特别慢，但是还能够使用，过了这段时间就好了。

    1、查看 slowlog，分析 slowlog，分析出查询慢的语句
    2、按照一定优先级，进行一个一个的排查所有慢语句。 
    3、分析 top sql，进行 explain 调试，查看语句执行时间。 
    4、调整索引或语句本身。


### 系统层面

- cpu 方面    
    vmstat、sar top、htop、nmon、mpstat
- 内存    
    free 、ps -aux 、
- IO 设备（磁盘、网络）  
    iostat 、 ss 、 netstat 、 iptraf、iftop、lsof、

vmstat 命令说明：   
```html
procs -----------memory---------- ---swap-- -----io---- -system-- ------cpu-----
 r  b   swpd   free   buff  cache   si   so    bi    bo   in   cs us sy id wa st
 1  0      0 7341400   2076 5014832    0    0     1    45   24   57  1  1 98  0  0

```    
    
        Procs：r 显示有多少进程正在等待 CPU 时间。
               b 显示处于不可中断的休眠的进程数量。在等待 I/O 
       Memory：swpd 显示被交换到磁盘的数据块的数量。未被使用的数据块，用户缓冲数据块，用于操作系统的数据块的数量 
       Swap：操作系统每秒从磁盘上交换到内存和从内存交换到磁盘的数据块的数量。
            s1 和 s0 最好是 0 
            Io：每秒从设备中读入 b1 的写入到设备 
            b0 的数据块的数量。反映了磁盘 I/O 
      System：显示了每秒发生中断的数量 (in) 和上下文交换 (cs) 的数量  
      Cpu：显示用于运行用户代码，系统代码，空闲，等待 I/O 的 CPU 时间

iostat 命令说明         

    实例命令： iostat -dk 1 5      iostat -d -k -x 5 （查看设备使用率（% util）和响应时间（await））
     tps：该设备每秒的传输次数。“一次传输” 意思是 “一次 I/O 请求”。多个逻辑请求可能会被合并为 “一次 I/O 请求”。
      iops ：硬件出厂的时候，厂家定义的一个每秒最大的 IO 次数 “一次传输” 请求的大小是未知的。 k
      B_read/s：每秒从设备（drive expressed）读取的数据量；
      KB_wrtn/s：每秒向设备（drive expressed）写入的数据量； 
      kB_read：读取的总数据量； 
      kB_wrtn：写入的总数量数据量；这些单位都为 Kilobytes。

#####  系统层面问题解决办

在实际的生产中，一般认为 cpu 只要不超过 90% 都没什么问题 。

- 问题一：cpu 负载高，IO 负载低
> 内存不够 磁盘性能差 SQL 问题 ——> 去数据库层，进一步排查 sql 问题 IO 出问题了（磁盘到临界了、raid 设计不好、raid 降级、锁、在单位时间内 tps 过高） tps 过高：大量的小数据 IO、大量的全表扫描
        
- 问题二：IO 负载高，cpu 负载低

>    大量小的 IO 写操作：       
>          autocommit ，产生大量小 IO     
>          IO/PS, 磁盘的一个定值，硬件出厂的时候，厂家定义的一个每秒最大的 IO       次数。     
>    大量大的 IO 写操作        
>          SQL 问题的几率比较大

- 问题三：IO 和 cpu 负载都很高

> 硬件不够了或 sql 存在问题
