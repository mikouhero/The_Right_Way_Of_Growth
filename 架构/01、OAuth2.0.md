# OAuth2.0

### 认证VS 授权
`认证` 就是要输入账号和密码来证明是我  
`授权` 就是并非通过账号和密码来把问我的东西借给其他人  

![](https://cdn.learnku.com/uploads/images/201811/22/29862/mZpBTyIkU1.png!large)

### 授权模式

##### 1.授权码模式
- 最常见的模式 ，微博、QQ 等都是这种模式
- 最繁琐的一种方式 
- 这种模式和其他最大的区别就在于是否有`授权码`这个步骤

###### 1.1、流程
> 1、第三方询问用户，要不要把你的用户数据给我呢 用户同意    
2、第三方于是就向认证服务器的【授权终点】发送了一个授权请求    
3、认证服务器的【授权终点】响应了一个授权画面   
4、用户看到了授权画面 这个画面就是我们上文的认证授权画面 用户填写自己的账号和密码    
5、用户将自己的账号和密码输入之后发送给了认证服务器的【授权验证终点】进行验证     
6、【授权验证点】通过了之后会发给第三方一个【授权码】   
7、第三方拿着授权码再去找认证服务器的【令牌终点】 
8、【令牌终点】发给第三方程序一个【令牌码】    
9、 第三方拿着令牌码去找资源服务器要用户数据    
10、  webAP这个守门员接口会找认证服务器要令牌码   
11、认证服务器把这个令牌码给资源服务器用来验证  
12、资源服务器验证临牌码后，把第三方请求的用户数据发送过去  
![](https://cdn.learnku.com/uploads/images/201812/20/29862/u45U6bbhWq.png!large)
###### 1.2、授权请求
```html
GET {认证终点}
?response_type=code           // 必选项
&client_id={客户端的ID}       // 必选项 
&redirect_uri={重定向URI}    // 可选项 
&scope={申请的权限范围}        // 可选项
&state={任意值}              // 推荐
HTTP/1.1
HOST: {认证服务器}
```
###### 1.3 授权响应
```html
HTTP/1.1 302 Found
Location: {重定向URI}
?code={授权码}          // 必填
&state={任意文字}       // 如果授权请求中包含 state的话那就是必填
```
###### 1.4 令牌请求
```html
POST {令牌终点} HTTP/1.1
Host: {认证服务器}
Content-Type: application/x-www-form-urlencoded

grant_type=authorization_code      // 必填
&code={授权码}                     // 必填　必须是认证服务器响应给的授权码
&redirect_uri={重定向URI}          // 如果授权请求中包含 redirect_uri 那就是必填
&code_verifier={验证码}            // 如果授权请求中包含 code_challenge 那就是必填
```
###### 1.5令牌响应  
```html
HTTP/1.1 200 OK
Content-Type: application/json;charset=UTF-8
Cache-Control: no-store
Pragma: no-cache

{
  "access_token":"{访问令牌}",      // 必填
  "token_type":"{令牌类型}",      // 必填
  "expires_in":{过期时间},        // 任意
  "refresh_token":"{刷新令牌}",   // 任意
  "scope":"{授权范围}"            // 如果请求和响应的授权范围不一致就必填
}
```
##### 简化模式
简化了授权码这个步骤
![](https://cdn.learnku.com/uploads/images/201812/20/29862/oxXdngCZiA.png!large)

##### 密码模式
密码迷失其实就是进一步简化了简化模式  
不仅仅没有了授权码模式下的授权码 也没了简化模式下的授权请求  
直接就请求了授权码
![](https://cdn.learnku.com/uploads/images/201812/20/29862/Th0J2IoD7o.png!large)

##### 客户端模式
最简化的模式  
什么都不问 直接请求 简单粗暴给我令牌 
![](https://cdn.learnku.com/uploads/images/201812/20/29862/1umyLwYvEe.png!large)

##### 刷新令牌
![](https://cdn.learnku.com/uploads/images/201812/20/29862/FWXv0Lp2yO.png!large)




|授权模式	|授权终点	|令牌终点|
| ---- | ----  | ----  |
|授权码模式|	使用|	使用|
|简化模式	|使用	|不使用|
|密码模式	|不使用|	使用|
|客户端模式|	不使用|	使用|
|刷新令牌|	不使用	|使用|

>其实授权终点就是授权请求和响应  
令牌终点就是令牌的请求和响应

