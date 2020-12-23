# Redis数据结构

1）String

最简单的KV存储（效率比Memcached高）。

> value也可以存数字，如：数字类型（数字类型可用Long表示时）。

````
set name JeasonBourne
````

2）hash

类似map的数据结构。

> 可存储结构化数据的同时只修改其中的部分属性，如：一个对象（对象中不能嵌套对象）。

````
hset person name JeasonBourne
hset person age 25
hset person sex man
hget person age
````

````
person = {
	"name": "JeasonBourne",
	"age": 25,
	"sex": "man"
}
````

3）list

有序列表。

> 可利用list存储列表型的数据结构，实现如存储粉丝列表、文章评论列表等。

> 可通过lrange命令实现高性能分页，如微博下拉刷新的分页操作。

````shell
# 0表示开始位置，-1表示结束位置，结束位置为-1时，表示列表的最后一个位置，即查看所有
lrange pageList 0 -1
````

> 可利用list存储的顺序结构，实现如简易版消息队列

````
lpush mqDemo 1
lpush mqDemo 2

rpop mqDemo
````

4）set

无序集合，自动去重。

> 可利用set的交集、并集和差集操作，实现如两个好友间的共同好友、可能认识的人等。

````shell
# 操作单个set
# 添加元素
sadd hisSet 1

# 查看全部元素
smembers hisSet

# 判断是否包含某个元素
sismember hisSet 1

# 删除某个/多个元素
srem hisSet 1
srem hisSet 2 4

# 查看元素个数
scard hisSet

# 随机删除一个元素
spop hisSet
````

````shell
# 操作多个set
# 将一个set的元素移动到另外一个set
smove yourSet hisSet 2

# 求两set的交集
sinter yourSet hisSet

# 求两set的并集
sunion yourSet hisSet

# 求在yourSet中而不在mySet中的元素
sdiff yourSet hisSet
````

5）sorted set

排序且去重的set（写入操作时给一个分数，自动根据分数排序，分数可重复，值会被去重）。

> 可利用sorted set的排序去重特性，实现如排行榜、成绩排名等功能。

````
zadd actors 85 JeasonBourne
zadd actors 72 MichaelScofield
zadd actors 96 TBAG
zadd actors 63 LincolnBurrows

# 获取排名前三的用户（默认是升序，所以需要 rev 改为降序）
zrevrange actors 0 3

# 获取某用户的排名
zrank actors TBAG
````

**2. 高级数据结构**

- bitmap
- hyperloglog
- GEO
- stream（Redis5.0+）
