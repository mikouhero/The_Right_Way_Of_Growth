<h1 align="center">《The Right Way Of Growth》V1.10</h1>



## 备注

状态        | 含义
--------- | -------
🈳️ | 当前未开始总结
🚗 | 总结中
🧀️ | 目前仅供参考未修正和发布
✅ | 总结完毕
🔧 | 查漏补缺修改中

## 目录

- PHP
  + 基础
    * [数组处理函数](https://www.php.net/manual/zh/book.array.php)
    * [魔术方法](https://www.php.net/manual/zh/language.oop5.magic.php)
    * [预定义变量](https://www.php.net/manual/zh/reserved.variables.php)
    * [接口与抽象类的区别](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%9F%BA%E7%A1%80/02%E3%80%81%E6%8E%A5%E5%8F%A3%E4%B8%8E%E6%8A%BD%E8%B1%A1%E7%B1%BB.md)
    * [static、self与$this的区别](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%9F%BA%E7%A1%80/05%E3%80%81static%E3%80%81self%E4%B8%8E$this%E7%9A%84%E5%8C%BA%E5%88%AB%20%E4%B8%8E%20%E5%90%8E%E6%9C%9F%E9%9D%99%E6%80%81%E7%BB%91%E5%AE%9A.md)
    * [引用](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%9F%BA%E7%A1%80/04%E3%80%81%E5%BC%95%E7%94%A8.md)
    * [include、require、include_once、require_once 的区别](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%9F%BA%E7%A1%80/01%E3%80%81include%E4%B8%8Erequire%E6%B7%B1%E5%85%A5%E4%BA%86%E8%A7%A3.md)
    * [类的静态调用与实例化调用](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%9F%BA%E7%A1%80/06%E3%80%81%E7%B1%BB%E7%9A%84%E9%9D%99%E6%80%81%E8%B0%83%E7%94%A8%E5%92%8C%E5%AE%9E%E4%BE%8B%E5%8C%96%E8%B0%83%E7%94%A8.md)
    * [会话管理](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%9F%BA%E7%A1%80/07%E3%80%81%E4%BC%9A%E8%AF%9D%E7%AE%A1%E7%90%86.md)
    * [回调与闭包](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%9F%BA%E7%A1%80/08%E3%80%81%E5%9B%9E%E8%B0%83%E4%B8%8E%E9%97%AD%E5%8C%85.md)
    
  + 进阶
    * [PHP运行模式](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%86%85%E6%A0%B8/1%E3%80%81PHP%E5%9B%9B%E7%A7%8D%E8%BF%90%E8%A1%8C%E6%A8%A1%E5%BC%8F.md)
        - CGI
        - Fastcgi模式
        - 模块模式
        - php-cli模式
    * [GC机制](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%86%85%E6%A0%B8/2%E3%80%81PHP%E7%9A%84GC%E6%9C%BA%E5%88%B6.md)
    * [php.ini 配置](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%86%85%E6%A0%B8/3%E3%80%81php.ini%E9%85%8D%E7%BD%AE.md)
    * [php-fpm.conf 配置](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%86%85%E6%A0%B8/4%E3%80%81php-fpm-conf.md)
    * [php与nginx的通信方式](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%86%85%E6%A0%B8/5%E3%80%81PHP%E4%B8%8Enginx%E7%9A%84%E9%80%9A%E4%BF%A1%E6%96%B9%E5%BC%8F.md)
    * [php-fpm与nginx 优化](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%86%85%E6%A0%B8/6%E3%80%81php-fpm%E4%B8%8Enginx%E4%BC%98%E5%8C%96.md)
    * [php 内存管理](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/PHP/%E5%86%85%E6%A0%B8/7%E3%80%81%E5%86%85%E5%AD%98%E7%AE%A1%E7%90%86.md)
        
  + 框架思想
    * 服务容器
    * 中间件
    * 门面（facade）
    * 控制反转与依赖注入
    * Pipeline 
    * 路由
    * ORM


- MySQL 
  + [引擎](https://github.com/mikouhero/The_Right_Way_Of_Growth/blob/master/MySQL/01%E3%80%81%E5%AD%98%E5%82%A8%E5%BC%95%E6%93%8E.md)
    * InnoDB
    * MyISAM
    * Memory
    * Archive
    * Blackhole\CSV\Federated\merge\NDB
  + 事务
    * 原子性（Atomicity）
    * 一致性（Consistency）
    * 隔离性（Isolation）
      - READ UNCOMMITTED:未提交读
      - READ COMMITTED：提交读/不可重复读
      - REPEATABLE READ：可重复读(MYSQL默认事务隔离级别)
      - SERIALIZEABLE：可串行化
    * 持久性（Durability）
    * 事务并发执行的问题
    * MVCC (多版本并发控制)    
  + 索引
    * 索引的基础知识
    * 索引提高检索速度
    * 建立表结构时添加的索引
      - 主键唯一索引
      - 唯一索引
      - 普通索引
      - 联合索引
    * 覆盖索引
    * 索引下推
    * 回表
    * 最左匹配原则
    * 依据是否聚簇区分
      - 聚簇索引
      - 非聚簇索引
    * 索引底层数据结构
      - hash索引
      - b-tree索引
      - b+tree索引
      - 有序数组索引
      - 跳表
      
  + 优化器
    * IO 成本
    * 单表查询的成本
    * 多表查询的成本
    * index dive   
    
  + Explain 
    * id 
    * select_type
    * table 
    * type 
    * possible_key 
    * key 
    * rows
    * filtered   
    * Extra
  + 锁
    * 悲观锁与乐观锁
    * 共享锁与排他锁
    * 行锁与表锁
    * 意向锁（InnoDB特有）
    * 死锁
    * 间隙锁
    
  + log日志
    * redo log（物理日志）
    * undo log 
    * bin log
  + 分表
    * 垂直分表
    * 水平分表
    
  + MySQL常见优化方式
    * 优化的范围
        - 应用程序
        - 数据库优化
    * 优化维度
        - 硬件
        - 系统配置 
        - 数据库表结构
        - SQL 及索引
    * 优化工具
        - 数据库层面
        - 系统层面
    * 数据库优化
        - SQL 优化方向
        - 架构优化方向
        - 数据库参数优化
        - 存储引擎层
        - SQL 层
  * 存储过程
  
  * 常见问题
    * 一条SQL语句执行得很慢的原因有哪些？  
    * MySQL的Limit性能问题
    * drop、delete与truncate分别在什么场景之下使用？
    * rowid 是什么？
    * SQL 约束
    * 如何正确地显示随机消息？
    * 为什么表数据删掉一半，表文件大小不变？
    * checkpoint 是什么？
        
  + 主从配置
    
  
- Redis 
  + Redis的基础数据结构
  + 常见用途
  + Redis 过期的key 是怎么清除的？
  + Redis的性能为什么这么高？
  + Linux中IO模型一共有哪些？
  + 同步与异步的区别是什么？
  + 阻塞与非阻塞的区别是什么？
  + 如何解决缓存与数据库的数据一致性问题？
  + 缓存穿透，雪崩，预热，更新，降级
  + Redis 持久化策略
  + Redis集群
  + Redis事务
  + Redis主从
  + Redis哨兵
  

- Nginx 
   + nginx 安装
   + nginx 命令行常用命令
   + nginx 与 php 通信
   + nginx 配置文件详解
   + nginx 配置动静分离
   + nginx 配置反向代理
   + nginx 配置负载均衡
   + nginx 配置跨域
   + nginx 配置跨域
     * 日志切割脚本
     * 图片防盗链
     * nginx 访问控制
     * 丢弃不受支持的文件扩展名的请求

 - Linux 
   + 常用命令
   + 进程 
     * 进程管理[ps命令] 
     * 进程管理[top命令]
     * 进程管理[kill命令]
     * 进程管理[进程优先级]
     * 进程管理[netstat命令]
   + IO 模型
   + 数据处理
   + 文件查找  
     
  

- 设计模式
     + 创建型模式实例
        * 单例模式
        * 工厂模式
        * 抽象工厂模式
        * 原型模式
        * 建造者模式
     + 结构型模式实例
        * 桥接模式
        * 享元模式
        * 外观模式
        * 适配器模式
        * 装饰器模式
        * 组合模式
        * 代理模式
        * 过滤器模式
    + 行为型模式实例
        * 模板模式
        * 策略模式
        * 状态模式
        * 观察者模式
        * 责任链模式
        * 访问者模式
        * 解释器模式
        * 备忘录模式
        * 命令模式
        * 迭代器模式
        * 中介者器模式
        * 空对象模式
        
   

  
- 数据结构 
  + 数组
  + 堆/栈
  + 树
  + 队列
  + 链表
  + 图
  + 散列表
- 算法 
  + 算法分析
    * 时间复杂度/空间复杂度/正确性/可读性/健壮性
  + 算法实战
    * 排序算法 
   
- 安全 

- 架构










