# 单点登录

单点登录英文全称Single Sign On，简称就是SSO。它的解释是：在多个应用系统中，只需要登录一次，就可以访问其他相互信任的应用系统。

## 普通登录的认证机制
![](https://upload-images.jianshu.io/upload_images/12540413-8cfaf1ba9956573f.png?imageMogr2/auto-orient/strip|imageView2/2/w/578/format/webp)

> 浏览器访问一个应用，这个应用需要登录    
用户填写账号和密码 完成认证 ，将用户的sesssion标记登录状态    
在浏览器中写入cookie ，这个cookie是这个用户的唯一标识   
下次访问这个应用，请求会带上这个cookie ,服务端更加这个cookie找到对应的session，通过session来判断这个用户是否登录






