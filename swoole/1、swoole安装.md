#### PHP源码编译安装[Ubuntu环境下]

* php.net 下载最新版本

```
wget https://www.php.net/distributions/php-7.3.5.tar.bz2
```

* 解压文件

```
tar -xvjf php-7.3.5.tar.bz2
```

* 进入解压文件内

```
cd php-7.3.5/
```

* 将php安装在指ope定文件执行

```
./configure --prefix=/home/path/
```


> 确保`gcc` 和 `libxml2-dev`、`autoconf`、`openssl`、`openssl-dev`、`libssl-dev`有安装，否则会出现类似下图错误   

![](./image/1.png)

> 安装以上扩展请执行：

```
sudo apt-get install libxml2-dev -y
sudo apt-get install gcc  -y 
sudo apt-get install build-essential -y
sudo apt-get install openssl -y 
sudo apt-get install libssl-dev -y
sudo apt-get install make -y
sudo apt-get install curl -y 
sudo apt-get install libcurl4-gnutls-dev -y
sudo apt-get install libjpeg-dev -y
sudo apt-get install libpng-dev -y 
sudo apt-get install libmcrypt-dev -y 
sudo apt-get install libreadline6 libreadline6-dev -y
```

* 编译

```
sudo make && sudo make install
```

* 验证查看安装的扩展

```
/bin/php -m
```
 
* 设置别名

```
vim $HOME/.bash_profile
```

or

```
sudo vim $HOME/profile
```

> i插入模式，shift+g跳转到末尾，新增：

```
alias php=/home/work/study/soft/php/bin/php
```

* 加载文件使之生效

```
source ~/.bash_profile
```

> php.ini 文件可以在安装包内copy  
> 使用 php -i|grep php.ini  将php.ini文件放在指定文件  
> export PATH=$PATH:/home/work/study/soft/php/bin/php

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


