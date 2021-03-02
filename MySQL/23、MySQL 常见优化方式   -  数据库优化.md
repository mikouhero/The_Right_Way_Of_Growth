# MySQL 常见优化方式   -  数据库优化

`SQL 优化方向`： 执行计划、索引、SQL 改写

`架构优化方向`： 高可用架构、高性能架构、分库分表

### 数据库参数优化

实例整体（高级优化，扩展）
```html
    thread_concurrency       # 并发线程数量个数
    sort_buffer_size         # 排序缓存
    read_buffer_size         # 顺序读取缓存
    read_rnd_buffer_size     # 随机读取缓存
    key_buffer_size          # 索引缓存
    thread_cache_size        # (1G—>8, 2G—>16, 3G—>32, >3G—>64)
```
连接层（基础优化）

设置合理的连接客户和连接方式

```html
    max_connections           # 最大连接数，看交易笔数设置    
    max_connect_errors        # 最大错误连接数，能大则大
    connect_timeout           # 连接超时
    max_user_connections      # 最大用户连接数
    skip-name-resolve         # 跳过域名解析
    wait_timeout              # 等待超时
    back_log                  # 可以在堆栈中的连接数量
```

### 存储引擎层 innodb 基础优化参数
```html
default-storage-engine
innodb_buffer_pool_size       # 没有固定大小，50%测试值，看看情况再微调。但是尽量设置不要超过物理内存70%
innodb_file_per_table=(1,0)
innodb_flush_log_at_trx_commit=(0,1,2) # 1是最安全的，0是性能最高，2折中
binlog_sync
Innodb_flush_method=(O_DIRECT, fdatasync)
innodb_log_buffer_size        # 100M以下
innodb_log_file_size          # 100M 以下
innodb_log_files_in_group     # 5个成员以下,一般2-3个够用（iblogfile0-N）
innodb_max_dirty_pages_pct   # 达到百分之75的时候刷写 内存脏页到磁盘。
log_bin
max_binlog_cache_size         # 可以不设置
max_binlog_size               # 可以不设置
innodb_additional_mem_pool_size    #小于2G内存的机器，推荐值是20M。32G内存以上100M
``` 

### SQL 层（基础优化）

- EXPLAIN：
    + 做 MySQL 优化，我们要善用 EXPLAIN 查看 SQL 执行计划，重点关注 type,key key_len ,row ,extra 
- SQL 语句中 IN 包含的值不应过多
    + MySQL 对于 IN 做了相应的优化，即将 IN 中的常量全部存储在一个数组里面，而且这个数组是排好序的。但是如果数值较多，产生的消耗也是比较大的。再例如：select id from table_name where num in(1,2,3) 对于连续的数值，能用 between 就不要用 in 了；再或者使用连接来替换。
    
- SELECT 语句务必指明字段名称
    +  ELECT * 增加很多不必要的消耗（cpu、io、内存、网络带宽）；增加了使用覆盖索引的可能性；当表结构发生改变时，前断也需要更新。所以要求直接在 select 后面接上字段名。

- 当只需要一条数据的时候，使用 limit 1     
    + 这是为了使 EXPLAIN 中 type 列达到 const 类型 

- 如果排序字段没有用到索引，就尽量少排序

-  如果限制条件中其他字段没有索引，尽量少用 or 
    + or 两边的字段中，如果有一个不是索引字段，而其他条件也不是索引字段，会造成该查询不走索引的情况。很多时候使用 union all 或者是 union (必要的时候) 的方式来代替 “or” 会得到更好的效果

- 尽量用 union all 代替 union
    + union 和 union all 的差异主要是前者需要将结果集合并后再进行唯一性过滤操作，这就会涉及到排序，增加大量的 CPU 运算，加大资源消耗及延迟。当然，union all 的前提条件是两个结果集没有重复数据。

- 不使用 ORDER BY RAND ()
```sql 
 select id from `table_name`  order by rand() limit 1000;

  select id from `table_name` t1 join
  (select rand() * (select max(id) from `table_name`) as nid) t2
  on t1.id > t2.nid limit 1000;

```

- 区分 in 和 exists， not in 和 not exists
    + 区分 in 和 exists 主要是造成了驱动顺序的改变（这是性能变化的关键），如果是 exists，那么以外层表为驱动表，先被访问，如果是 IN，那么先执行子查询。所以 IN 适合于外表大而内表小的情况；EXISTS 适合于外表小而内表大的情况。

``` sql
    select * from 表A where id in (select id from 表B)；
    
 select * from 表A where exists
  (select * from 表B where 表B.id=表A.id)
```


- 使用合理的分页方式以提高分页的效率
  + 上述 sql 语句做分页的时候，可能有人会发现，随着表数据量的增加，直接使用 limit 分页查询会越来越慢。
    优化的方法如下：可以取前一页的最大行数的 id，然后根据这个最大的 id 来限制下一页的起点

   ```sql
   select id,name from table_name limit 866613, 20 ;
    select id,name from table_name where id> 866612 limit 20;
   ```
   
- 分段查询  

- 避免在 where 子句中对字段进行 null 值判断 
    + 对于 null 的判断会导致引擎放弃使用索引而进行全表扫描

- 不建议使用 % 前缀模糊查询    
- 避免在 where 子句中对字段进行表达式操作
- 避免隐式类型转换
- 对于联合索引来说，要遵守最左前缀法则
    + 举列来说索引含有字段 id,name,school，可以直接用 id 字段，也可以 id,name 这样的顺序，但是 name，school 都无法使用这个索引。所以在创建联合索引的时候一定要注意索引字段顺序，常用的查询字段放在最前面


-  必要时可以使用 force index 来强制查询走某个索引
    + 有的时候 MySQL 优化器采取它认为合适的索引来检索 sql 语句，但是可能它所采用的索引并不是我们想要的。这时就可以采用 force index 来强制优化器使用我们制定的索引

- 注意范围查询语句
    + 对于联合索引来说，如果存在范围查询，比如 between,>,< 等条件时，会造成后面的索引字段失效。
    
- 关于 JOIN 优化    
![](https://cdn.learnku.com/uploads/images/202003/25/32535/gLnZiSCQnT.png)
    + LEFT JOIN A 表为驱动表     
    + INNER JOIN MySQL 会自动找出那个数据少的表作用驱动表      
    + RIGHT JOIN B 表为驱动表      
    ```html
    注意：MySQL 中没有 full join，可以用以下方式来解决
     select * from A left join B on B.name = A.name where B.name is null union all select * from B;
    ```
尽量使用 inner join，避免 left join
> 参与联合查询的表至少为 2 张表，一般都存在大小之分。如果连接方式是 inner join，在没有其他过滤条件的情况下 MySQL 会自动选择小表作为驱动表，但是 left join 在驱动表的选择上遵循的是左边驱动右边的原则，即 left join 左边的表名为驱动表。

+ 合理利用索引
+ 被驱动表的索引字段作为 on 的限制字段。
+ 利用小表去驱动大表

![](https://cdn.learnku.com/uploads/images/202003/25/32535/psl0Lwdqqp.png)
从原理图能够直观的看出如果能够减少驱动表的话，减少嵌套循环中的循环次数，以减少 IO 总量及 CPU 运算的次数。
巧用 STRAIGHT_JOIN
> inner join 是由 mysql 选择驱动表，但是有些特殊情况需要选择另个表作为驱动表，比如有 group by、order by 等「Using filesort」、「Using temporary」时。STRAIGHT_JOIN 来强制连接顺序，在 STRAIGHT_JOIN 左边的表名就是驱动表，右边则是被驱动表。在使用 STRAIGHT_JOIN 有个前提条件是该查询是内连接，也就是 inner join。其他链接不推荐使用 STRAIGHT_JOIN，否则可能造成查询结果不准确。

