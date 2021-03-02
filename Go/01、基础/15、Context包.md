# 15 Context 包

### 为什么需要Context
在 Go http包的Server中，每一个请求在都有一个对应的 goroutine 去处理。请求处理函数通常会启动额外的 goroutine 用来访问后端服务，比如数据库和RPC服务。用来处理一个请求的 goroutine 通常需要访问一些与请求特定的数据，比如终端用户的身份认证信息、验证相关的token、请求的截止时间。 当一个请求被取消或超时时，所有用来处理该请求的 goroutine 都应该迅速退出，然后系统才能释放这些 goroutine 占用的资源。 

### 处理方案

- 全局变量方式
 1. 使用全局变量在跨包调用时不容易统一   
 2. 如果worker中再启动goroutine，就不太好控制了。  

- 通道方式
1. 使用全局变量在跨包调用时不容易实现规范和统一，需要维护一个共用的channel

- 官方版的方案（Context）


### Context初识
对服务器传入的请求应该创建上下文，而对服务器的传出调用应该接受上下文。它们之间的函数调用链必须传递上下文，或者可以使用WithCancel、WithDeadline、WithTimeout或WithValue创建的派生上下文。当一个上下文被取消时，它派生的所有上下文也被取消。  



### Context接口


context.Context是一个接口，该接口定义了四个需要实现的方法。具体签名如下：
```golang
type Context interface {
    Deadline() (deadline time.Time, ok bool)
    Done() <-chan struct{}
    Err() error
    Value(key interface{}) interface{}
}
```

- Deadline方法需要返回当前Context被取消的时间，也就是完成工作的截止时间（deadline）；
- Done方法需要返回一个Channel，这个Channel会在当前工作完成或者上下文被取消之后关闭，多次调用Done方法会返回同一个Channel；
- Err方法会返回当前Context结束的原因，它只会在Done返回的Channel被关闭时才会返回非空的值；        
    > 如果当前Context被取消就会返回Canceled错误；       
    > 如果当前Context超时就会返回DeadlineExceeded错误；        
- Value方法会从Context中返回键对应的值，对于同一个上下文来说，多次调用Value 并传入相同的Key会返回相同的结果，该方法仅用于传递跨API和进程间跟请求域的数据；


