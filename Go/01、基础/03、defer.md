# defer

- 特性
> 用于注册延时调用    
这些调用直到 return 前才被执行 可以用来做资源清理  
多个defer 调用 按照先进后出的方式执行  
defer语句中的变量，在defer 声明时就决定了

- 用途 
> 关闭文件句柄    
锁资源释放   
数据库连接释放  



```golang

  var  a [5]struct{}

	for i:= range a  {
		defer func() {
			fmt.Println(i)
		}()
	}
  
  // 4 4 4 4 4  于闭包用到的变量 i 在执行的时候已经变成4,所以输出全都是4.
  
  
  
  func test() {
    x, y := 10, 20

    defer func(i int) {
        println("defer:", i, y) // y 闭包引用
    }(x) // x 被复制

    x += 10
    y += 100
    println("x =", x, "y =", y)
}

func main() {
    test()
}

//   x = 20 y = 120
    //   defer: 10 120
```
