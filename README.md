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
    * 接口与抽象类的区别
    * static、self与$this的区别
    * 传值与引用
    * include、require、include_once、require_once 的区别
    * 类的静态调用与实例化调用
    * 会话管理
    
  + 进阶
    * 回调与闭包
    * PHP运行模式
        - CGI
        - Fastcgi模式
        - 模块模式
        - php-cli模式
    * GC机制
    * php.ini 配置
    * php-fpm.conf 配置
    * php与nginx的通信方式
    * php-fpm与nginx 优化
    * php 内存管理
        
  + 框架思想
    * 服务容器
    * 中间件
    * 门面（facade）
    * 控制反转与依赖注入
    * Pipeline 
    * 路由
    * ORM
    
- Linux
- Nginx
- MySQL 
  + 引擎
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
  + 索引
    * 建立表结构时添加的索引
      - 主键唯一索引
      - 唯一索引
      - 普通索引
      - 联合索引
    * 最左匹配原则
    * 依据是否聚簇区分
      - 聚簇索引
      - 非聚簇索引
    * 索引底层数据结构
      - hash索引
      - b-tree索引
      - b+tree索引
  + 锁
    * 悲观锁
    * 乐观锁
  + 分表
    * 垂直分表
    * 水平分表
  + sql优化
  + 主从配置
- Redis 
  + 常见用途

  + Redis的基础数据结构
- 设计模式
  + 概念
  
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










