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

### SQL 注入
