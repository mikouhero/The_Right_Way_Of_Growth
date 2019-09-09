# PHP 的回收机制

[官网文档](https://www.php.net/manual/zh/features.gc.php "标题")   
[说明的比较清楚](https://www.cnblogs.com/orlion/p/5350844.html)

### 引用和计数 

> 每个php变量存在一个叫"zval"的变量容器中。除了包含变量的类型和值，还包括两个字节的额外信息: `is_ref` 和 `refcount`

- is_ref:
>是个bool值，用来标识这个变量是否是属于引用集合(reference set)。通过这个字节，php引擎才能把普通变量和引用变量区分开来
- refcount:
> 用以表示指向这个zval变量容器的变量(也称符号即symbol)个数

```php 
$a = "new string";
$b = $a;
xdebug_debug_zval( 'a' );

// a: (refcount=2, is_ref=0)='new string'

$a = array( 'meaning' => 'life', 'number' => 42 );
xdebug_debug_zval( 'a' );

//a: (refcount=1, is_ref=0)=array (
//   'meaning' => (refcount=1, is_ref=0)='life',
//   'number' => (refcount=1, is_ref=0)=42
//)

$a = array( 'one' );
$a[] =& $a;
xdebug_debug_zval( 'a' );

//a: (refcount=2, is_ref=1)=array (
//   0 => (refcount=1, is_ref=0)='one',
//   1 => (refcount=2, is_ref=1)=...
//)

```

### 新的GC 算法
1：如果一个zval的refcount增加，那么此zval还在使用，不属于垃圾

2：如果一个zval的refcount减少到0， 那么zval可以被释放掉，不属于垃圾

3：如果一个zval的refcount减少之后大于0，那么此zval还不能被释放，此zval可能成为一个垃圾