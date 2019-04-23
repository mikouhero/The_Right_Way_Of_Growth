# HTTP的发展历史
## HTTP/0.9
> 只有一个命令 GET   
> 没有HEADER等描述数据的信息    
> 服务器发送完毕，就关闭TCP 连接

## HTTP/1.0
> 增加了很多命令 post put  header 等  
> 增加了status code header  
> 多字符集支持、多部分发送、权限、缓存等

## HTTP/1.1 
> 支持持久连接     
> 支持pipeline   
> 增加host 和其它命令  

## HTTP/2.0
> 所有的数据以二进制传输  
> 同一个连接里面发送多个请求不在需要按照顺序来  
> 头信息压缩以及推送等提高效率的功能  