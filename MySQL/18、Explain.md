# Explain

### id 
一般来说一个select一个唯一id，如果是子查询，就有两个select，id是不一样的，但是凡事有例外，有些子查询的，他们id是一样的。

![](https://user-gold-cdn.xitu.io/2020/1/7/16f7e90ea96d5d0d)    
那是因为MySQL在进行优化的时候已经将子查询改成了连接查询，而连接查询的id是一样的。

### select_type
+ simple：不包括union和子查询的查询都算simple类型。
+ primary：包括union，union all，其中最左边的查询即为primary。
+ union：包括union，union all，除了最左边的查询，其他的查询类型都为union。

### table 
显示这一行是关于哪张表的。   


### type：访问方法
- ref：普通二级索引与常量进行等值匹配
- ref_or_null：普通二级索引与常量进行等值匹配，该索引可能是null
- const：主键或唯一二级索引列与常量进行等值匹配
- range：范围区间的查询
- all：全表扫描

### possible_keys
对某表进行单表查询时可能用到的索引   

### key
经过查询优化器计算不同索引的成本，最终选择成本最低的索引

### key_len
实际索引长度

### ref 
与索引比较的列

### rows
- 如果使用全表扫描，那么rows就代表需要扫描的行数
- 如果使用索引，那么rows就代表预计扫描的行数

### filtered
- 如果全表扫描，那么filtered就代表满足搜索条件的记录的满分比
- 如果是索引，那么filtered就代表除去索引对应的搜索，其他搜索条件的百分比

### Extra
查看附加信息：排序、临时表、where条件为false等
