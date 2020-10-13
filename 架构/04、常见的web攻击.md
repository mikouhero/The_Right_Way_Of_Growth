# 常见的web攻击


### 跨站脚本攻击（XSS）
跨站脚本攻击(Cross Site Script，简称 XSS)，利用网页开发时留下的漏洞，通过巧妙的方法注入恶意指令代码到网页，使用户加载并执行攻击者恶意制造的网页程序
```php
  $input = $_GET['param'];
  echo "<div>".$input."</div>";
  
  https://blog.maplemark.cn/test.php?param=这是一个测试!
  https://blog.maplemark.cn/test.php?param=<script>alert(/xss/)</script>
  
```
##### 分类
-  反射型xss : 简单的将用户输入的数据反射给浏览器 
- 存储型xss : 把用户输入的数据存储在服务器端  
- DOM Bases Xss ： 修改页面DOM 节点形成xss 

##### xss 防御
- 为cookie 设置httpOnly ，避免cookie 被劫持泄露
- 对输入输出进行检查 明确编码方式


### 跨站点请求伪造(CSRF)
跨站请求伪造(Cross-site request forgery,简称 CSRF)， 是一种挟制用户在当前已登录的 Web 应用程序上执行非本意的操作的攻击方法
- 示例
```html
    <!--仅用于演示，假设该点赞为 GET-->
<img src="https://segmentfault.com/api/article/1190000019050946/like?_=0faa0315ff95872d8b0f8da02e343ac7">
  诱使目标用户访问页面P
  如果你已经访问过 SF 网站，并且已经登录。可以看到在访问页面P之后，已经对 SF 文章进行点赞了
```
- 防御
 > 增加验证码（简单有效）  
 检查请求来源是否合法 
 增加随机token


### SQL 注入
输入的字符串注入SQL指令，若程序中忽略了字符检查，导致恶意指令被执行而遭到破坏或入侵

- 示例
```html
    $id = $_GET["id"];  //1;DROP TABLE OrdersTable--
  $sql = "select * from user where `id`= {$id}"
```

- 防御
>  使用预编译语句绑定变量（最佳方式）  
使用安全的存储过程（也可能存在）  
检查输入的数据类型（可对抗注入）  
数据库最小权限原则·  



