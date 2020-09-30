# 单点登录

单点登录英文全称Single Sign On，简称就是SSO。它的解释是：在多个应用系统中，只需要登录一次，就可以访问其他相互信任的应用系统。

## 普通登录的认证机制
![](https://upload-images.jianshu.io/upload_images/12540413-8cfaf1ba9956573f.png?imageMogr2/auto-orient/strip|imageView2/2/w/578/format/webp)

> 浏览器访问一个应用，这个应用需要登录    
用户填写账号和密码 完成认证 ，将用户的sesssion标记登录状态    
在浏览器中写入cookie ，这个cookie是这个用户的唯一标识   
下次访问这个应用，请求会带上这个cookie ,服务端更加这个cookie找到对应的session，通过session来判断这个用户是否登录


## 同域下的单点登录
> 一个企业一般情况下只有一个域名，通过二级域名区分不同的系统。比如我们有个域名叫做：a.com，同时有两个业务系统分别为：app1.a.com和app2.a.com。我们要做单点登录（SSO），需要一个登录系统，叫做：sso.a.com。

> 我们只要在sso.a.com登录，app1.a.com和app2.a.com就也登录了。通过上面的登陆认证机制，我们可以知道，在sso.a.com中登录了，其实是在sso.a.com的服务端的session中记录了登录状态，同时在浏览器端（Browser）的sso.a.com下写入了Cookie。那么我们怎么才能让app1.a.com和app2.a.com登录呢？这里有两个问题
- Cookie是不能跨域的，我们Cookie的domain属性是sso.a.com，在给app1.a.com和app2.a.com发送请求是带不上的
- sso、app1和app2是不同的应用，它们的session存在自己的应用内，是不共享的。

![](https://upload-images.jianshu.io/upload_images/12540413-ddff3256817e357b.png?imageMogr2/auto-orient/strip|imageView2/2/w/783/format/webp)

![](https://cdn.learnku.com/uploads/images/201903/23/17490/2j8GmyFCeG.png!large)

> 那么我们如何解决这两个问题呢？针对第一个问题，sso登录以后，可以将Cookie的域设置为顶域，即.a.com，这样所有子域的系统都可以访问到顶域的Cookie。我们在设置Cookie时，只能设置顶域和自己的域，不能设置其他的域。比如：我们不能在自己的系统中给baidu.com的域设置Cookie。

> Cookie的问题解决了，我们再来看看session的问题。我们在sso系统登录了，这时再访问app1，Cookie也带到了app1的服务端（Server），app1的服务端怎么找到这个Cookie对应的Session呢？这里就要把3个系统的Session共享，如图所示。共享Session的解决方案有很多，例如：Spring-Session。这样第2个问题也解决了。

同域下的单点登录就实现了，但这还不是真正的单点登录。

## 不同域下的单点登录

![](https://upload-images.jianshu.io/upload_images/12540413-041b3228c5e865e8.png)




