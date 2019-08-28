# PHP 的运行模式

1）cgi 通用网关接口（Common Gateway Interface)）  
2） fast-cgi 常驻 (long-live) 型的 CGI  
3） cli  命令行运行   （Command Line Interface）  
4）web模块模式 （apache等web服务器运行的模块模式）  

### 1、CGI 

> CGI即通用网关接口(Common Gateway Interface)，它是一段程序, 通俗的讲CGI就象是一座桥，把网页和WEB服务器中的执行程序连接起来，它把HTML接收的指令传递给服务器的执行程序，再把服务器执行程序的结果返还给HTML页。CGI 的跨平台性能极佳，几乎可以在任何操作系统上实现。 CGI已经是比较老的模式了，这几年都很少用了。  
> 每有一个用户请求，都会先要创建cgi的子进程，然后处理请求，处理完后结束这个子进程，这就是fork-and-execute模式。 当用户请求数量非常多时，会大量挤占系统的资源如内存，CPU时间等，造成效能低下。所以用cgi方式的服务器有多少连接请求就会有多少cgi子进程，子进程反复加载是cgi性能低下的主要原因。  
> 如果不想把 PHP 嵌入到服务器端软件（如 Apache）作为一个模块安装的话，可以选择以 CGI 的模式安装。或者把 PHP 用于不同的 CGI 封装以便为代码创建安全的 chroot 和 setuid 环境。这样每个客户机请求一个php文件，Web服务器就调用php.exe（win下是php.exe,linux是php）去解释这个文件，然后再把解释的结果以网页的形式返回给客户机。 这种安装方式通常会把 PHP 的可执行文件安装到 web 服务器的 cgi-bin 目录。CERT 建议书 CA-96.11 建议不要把任何的解释器放到 cgi-bin 目录。

### 2、Fastcgi模式

> fast-cgi 是cgi的升级版本，FastCGI 像是一个常驻 (long-live) 型的 CGI，它可以一直执行着，只要激活后，不会每次都要花费时间去 fork 一次 (这是 CGI 最为人诟病的 fork-and-execute 模式)。  

>php-fpm启动->  
生成n个fast-cgi协议处理进程->  
监听一个端口等待任务用户请求->  
web服务器接收请求->  
请求转发给php-fpm->  
php-fpm交给一个空闲进程处理->  
进程处理完成->  
php-fpm返回给web服务器->  
web服务器接收数据->  
返回给用户   


### 3、模块模式

>apache+php运行时,默认使用的是模块模式,它把php作为apache的模块随apache启动而启动,接收到用户请求时则直接通过调用mod_php模块进行处理。  
​ 模块模式是以mod_php5模块的形式集成，此时mod_php5模块的作用是接收Apache传递过来的PHP文件请求，并处理这些请求，然后将处理后的结果返回给Apache。如果我们在Apache启动前在其配置文件中配置好了PHP模块（mod_php5），PHP模块通过注册apache2的ap_hook_post_config挂钩，在Apache启动的时候启动此模块以接受PHP文件的请求

### 4、php-cli模式

　　php-cli模式属于命令行模式,对于很多刚开始学php就开始wamp,wnmp的开发者来说是最陌生的一种运行模式。该模式不需要借助其他程序,直接输入php xx.php 就能执行php代码，命令行模式和常规web模式明显不一样的是:

- 没有超时时间  
- 默认关闭buffer缓冲  
- STDIN和STDOUT标准输入/输出/错误 的使用  
- echo var_dump,phpinfo等输出直接输出到控制台  
- 可使用的类/函数 不同  
- php.ini配置的不同  