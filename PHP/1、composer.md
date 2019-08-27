#  composer 

## LINUX 安装 composer

> php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');"

> php composer-setup.php 

移动 composer.phar，这样 composer 就可以进行全局调用：
> mv composer.phar /usr/local/bin/composer

切换为国内镜像：

> composer config -g repo.packagist composer https://packagist.phpcomposer.com

## PHP 安装在指定目录 ‘/usr/bin/env:php NO such file  or dir’
解决办法 

>建立硬连接     
ln /php安装地址    /usr/local/bin/php  

> 使用php composer.phar 代替composer    composer.phar为绝对路径

## LINUX  添加环境变量PHP 其他同理

> 运行命令export PATH=$PATH:/PHP安装地址

>执行vi ~/.bash_profile修改文件中PATH一行，将/PHP安装地址 加入到PATH=$PATH:$HOME/bin一行之后

> 修改/etc/profile文件使其永久性生效，并对所有系统用户生效，在文件末尾加上如下两行代码   
PATH=$PATH:/usr/local/webserver/php/bin:/usr/local/webserver/mysql/bin
export PATH
最后：执行 命令source /etc/profile或 执行点命令 ./profile使其修改生效，执行完可通过echo $PATH命令查看是否添加成功。  