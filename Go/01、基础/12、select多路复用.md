# select多路复用

select的使用类似于switch语句，它有一系列case分支和一个默认的分支。每个case会对应一个通道的通信（接收或发送）过程。select会一直等待，直到某个case的通信操作完成时，就会执行case分支对应的语句。具体格式如下：

```golang 
  
  select{
    case <-ch1:
        // 如果chan1成功读到数据，则进行该case处理语句
    case data := <-ch2:
       // 如果chan3成功读到数据，则进行该case处理语句
    case ch3<-data:
        ...
    default:
        // 如果上面都没有成功，则进入default处理流程
}

```

使用select 语句能够提高代码的可读性
- 可处理一个或多个channel的发送/接收操作。    
- 如果多个case同时满足，select会随机选择一个。    
- 对于没有case的select{}会一直等待，可用于阻塞main函数。

```golang
// 判断管道有没有存满
func main() {
	// 创建管道
	output1 := make(chan string, 10)
	// 子协程写数据
	go write(output1)
	// 取数据
	for s := range output1 {
		fmt.Println("res:", s)
		time.Sleep(time.Second)
	}
}

func write(ch chan string) {
	for {
		select {
		// 写数据
		case ch <- "hello":
			fmt.Println("write hello")
		default:
			fmt.Println("channel full")
		}
		time.Sleep(time.Millisecond * 500)
	}
}
```
