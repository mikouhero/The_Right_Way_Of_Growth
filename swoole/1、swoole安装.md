### 源码编译安装PHP[Ubuntu环境下]

> 运行目录：`~`，即家目录，全称：`/home/`，昵称：`$HMOE`
> 安装目录：`~/work/study/soft/php`，PHP安装路径文件夹

* 下载最新版本

```
[michael@Ubuntu]$ wget https://www.php.net/distributions/php-7.3.5.tar.bz2
```

* 解压文件

```
[michael@Ubuntu]$ tar -xvjf php-7.3.5.tar.bz2
```

* 进入解压文件内

```
[michael@Ubuntu]$ cd php-7.3.5/
```

* 将php安装在指定文件，执行

```
[michael@Ubuntu]$ ./configure --prefix=~/work/study/soft/php
```

> 确保`gcc`、`libxml2-dev`、`autoconf`、`openssl`、`openssl-dev`和`libssl-dev`已安装，否则会出现类似下图错误  

![](./image/1.png)

> 安装以上扩展请执行：

```
[michael@Ubuntu]$ sudo apt-get -y install gcc libxml2-dev autoconf openssl openssl-dev libssl-dev 
``` 

> 其他安装请分别执行：

```
sudo apt-get install curl -y
sudo apt-get install make -y
sudo apt-get install libpng-dev -y
sudo apt-get install libjpeg-dev -y
sudo apt-get install libmcrypt-dev -y
sudo apt-get install build-essential -y
sudo apt-get install libcurl4-gnutls-dev -y
sudo apt-get install libreadline6 libreadline6-dev -y
```

* 编译安装

```
[michael@Ubuntu]$  sudo make && sudo make install
```

* 验证查看安装的扩展

```
[michael@Ubuntu]$ ~/work/study/soft/php/bin/php -m
```
 
* 设置别名

> 如果想让命令全局生效的话：

> bash用户编辑`~/.bash_profile`，[UNIX通用命令文件]

> zsh用户编辑`~/.zshrc`，[需安装，高本版Ubuntu自带]

> 如果只是想当前用户生效的话，编辑`~/profile`

```
[michael@Ubuntu]$ sudo vim ~/.bash_profile
```

> shift+g跳转到末尾，i插入模式，新增：

```
alias php=~/work/study/soft/php/bin/php
```

> 如果你觉得编辑太麻烦，请执行：

```
[michael@Ubuntu]$ echo "alias php=~/work/study/soft/php/bin/php" >> ~/.bash_profile
```

* 加入全局变量
```
[michael@Ubuntu]$ echo "export PATH=$PATH:~/work/study/soft/php/bin/php" >> ~/.bash_profile
```

* 加载文件使之生效

```
[michael@Ubuntu]$ source ~/.bash_profile
```

* 查看php.ini的路径

```
[michael@Ubuntu]$ php -i|grep php.ini
```

---

##  通过phpize为php在不重新编译php情况下安装openssl  
>php源码路径：/home/work/study/softpackage/php-7.3.5 
安装路径：/home/work/study/soft/php
php.ini路径：/home/work/study/soft/php/lib  

进入php下载解压目录  
cd /home/work/study/softpackage/php-7.3.5/ext/openssl  
运行phpize  
  /home/work/study/soft/php/phpize  
如果出现Cannot find config.m4.报错，则  
  cp config0.m4 config.m4  
执行安装  
./configure --with-openssl --with-php-config=/home/work/study/soft/php/bin/php-config  
make && make install  
安装完成后，会提示在某个目录生成.so文件，我的生成位置是  
/home/work/study/soft/php/lib/php/extensions/no-debug-non-zts-20170718/  
打开php.ini，添加以下两行  
extension_dir = "/home/work/study/soft/php/lib/php/extensions/no-debug-non-zts-20170718/"  
extension=openssl.so  
重启php即可  


-------- 
 // 通过 pecl.php.net  pecl
sudo /home/work/study/soft/php/bin/pecl  install swoole-4.3.4.tgz
卸载   sudo /home/work/study/soft/php/bin/pecl  uninstall                                       
php --ri swoole

  
  
  ./configure --enable-coroutine  --enable-openssl   --enable-http2   --enable-async-redis  --enable-sockets  --enable-mysqlnd
  
  
  
  ./configure --prefix=/home/work/study/soft/php  --with-config-file-path=/home/work/study/soft/php/etc --enable-fpm --with-fpm-user=www --with-fpm-group=www --with-mysqli --with-pdo-mysql --with-iconv-dir --with-freetype-dir --with-zlib --with-libxml-dir=/usr --enable-xml --disable-rpath --enable-bcmath --enable-shmop --enable-sysvsem --enable-inline-optimization  --enable-mbregex --enable-mbstring  --enable-ftp --with-openssl --with-mhash --enable-pcntl --enable-sockets --with-xmlrpc --enable-zip --enable-soap --without-pear --with-gettext --disable-fileinfo --enable-maintainer-zts 
  

./configure --prefix=/home/work/study/soft/php7.3.5 --with-mysqli --with-pdo-mysql --with-iconv-dir --with-freetype-dir --with-jpeg-dir --with-png-dir --with-zlib --with-libxml-dir --enable-simplexml --enable-xml --disable-rpath --enable-bcmath --enable-soap --enable-zip --with-curl --enable-fpm --with-fpm-user=www --with-fpm-group=www --enable-mbstring --enable-sockets --with-gd --with-openssl --with-mhash --enable-opcache --disable-fileinfo


