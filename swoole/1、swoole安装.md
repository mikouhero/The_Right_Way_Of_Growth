# php 源码安装

## php 源码安装
>php.net 下载最新版本 
wget https://www.php.net/distributions/php-7.3.5.tar.bz2  
>  解压文件   
>  tar -xvjf php...   
> 进入解压文件内  将php 安装在指定文件 执行 ./configure --prefix=/home/.....
> 执行./configure 要确保gcc 和 libxml2-dev  autoconf openssl openssl-dev/ libssl-dev 有安装 否者会出现 类似下图错误   

![](./image/1.png)

> 编译  make && make install   
>进入安装目录 执行./bin/php -m  查看安装的扩展  
 
> 设置php别名  vim .bash_profile(在家目录下面) 或.profile  
> 添加alias php=/home/work/study/soft/php/bin/php  
> source .bash_profile 使文件生效  
> php.ini 文件可以在安装包内copy  
> 使用 php -i|grep php.ini  将php.ini文件放在指定文件  


##  通过phpize为php在不重新编译php情况下安装openssl  
>php源码路径：/opt/download/php-7.2.  
安装路径：/opt/soft/php  
php.ini路径：/opt/soft/php/lib  

进入php下载解压目录  
cd /opt/download/php-7.2.5/ext/openssl  
运行phpize  
/opt/soft/php/bin/phpize  
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


