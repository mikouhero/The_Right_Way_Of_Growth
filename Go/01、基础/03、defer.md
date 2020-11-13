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



```golang 
func test(x int) {
    defer println("a")
    defer println("b")

    defer func() {
        println(100 / x) // div0 异常未被捕获，逐步往外传递，最终终止进程。
    }()

    defer println("c")
}

func main() {
    test(0)
}

 c
    b
    a
    panic: runtime error: integer divide by zero

// 多个 defer 注册，按 FILO 次序执行 ( 先进后出 )。哪怕函数或某个延迟调用发生错误，这些调用依旧会被执行。
```
## defer 的执行时机

![](https://www.liwenzhou.com/images/Go/func/defer.png)



```


func f1() int {
	x := 5
	defer func() {
		x++
	}()
	return x
}

func f2() (x int) {
	defer func() {
		x++
	}()
	return 5
}

func f3() (y int) {
	x := 5
	defer func() {
		x++
	}()
	return x
}
func f4() (x int) {
	defer func(x int) {
		x++
	}(x)
	return 5
}
func main() {
	fmt.Println(f1())  // 5
	fmt.Println(f2())  // 6
	fmt.Println(f3())  //5
	fmt.Println(f4())  //5
}
```


