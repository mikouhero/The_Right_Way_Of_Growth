#  drop、delete与truncate分别在什么场景之下使用？
###     drop table
    1)属于DDL
    2)不可回滚
    3)不可带where
    4)表内容和结构删除
    5)删除速度快

###     truncate table
    1)属于DDL
    2)不可回滚
    3)不可带where
    4)表内容删除
    5)删除速度快

###     delete from
    1)属于DML
    2)可回滚
    3)可带where
    4)表结构在，表内容要看where执行的情况
    5)删除速度慢,需要逐行删除
    不再需要一张表的时候，用drop
    想删除部分数据行时候，用delete，并且带上where子句
    保留表而删除所有数据的时候用truncate
    
    
### 总结
1、在速度上，一般来说，drop> truncate > delete。

2、在使用drop和truncate时一定要注意，虽然可以恢复，但为了减少麻烦，还是要慎重。

3、如果想删除部分数据用delete，注意带上where子句，回滚段要足够大；
    如果想删除表，当然用drop； 
    如果想保留表而将所有数据删除，如果和事务无关，用truncate即可；
    如果和事务有关，或者想触发trigger，还是用delete；
    如果是整理表内部的碎片，可以用truncate跟上reuse stroage，再重新导入/插入数据。
