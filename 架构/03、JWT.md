# JWT 

### json web token 是什么？
> JSON Web Token (JWT)是一个开放标准(RFC 7519)，它定义了一种紧凑的、自包含的方式，用于作为JSON对象在各方之间安全地传输信息。该信息可以被验证和信任，因为它是数字签名的。

### 认证方式
- cookie-session 认证
- token 认证

##### cookie-session认证的缺点
> 传统的session认证,随着不同客户端用户的增加，独立的服务器已无法承载更多的用户，而这时候基于session认证应用的问题就会暴露出来.例如而随着认证用户的增多，服务端的开销会明显增大，这样在分布式的应用上，相应的限制了负载均衡器的能力，因为是基于cookie来进行用户识别的, cookie如果被截获，用户就会很容易受到XSS攻击。

##### token 验证
> 基于token的鉴权机制类似于http协议也是无状态的，它不需要在服务端去保留用户的认证信息或者会话信息。这就意味着基于token认证机制的应用不需要去考虑用户在哪一台服务器登录了，这就为应用的扩展提供了便利

### 什么时候使用JWT 
- Authorization (授权) : 这是使用JWT的最常见场景。一旦用户登录，后续每个请求都将包含JWT，允许用户访问该令牌允许的路由、服务和资源。单点登录是现在广泛使用的JWT的一个特性，因为它的开销很小，并且可以轻松地跨域使用。
- Information Exchange (信息交换) : 对于安全的在各方之间传输信息而言，JSON Web Tokens无疑是一种很好的方式。因为JWT可以被签名，例如，用公钥/私钥对，你可以确定发送人就是它们所说的那个人。另外，由于签名是使用头和有效负载计算的，您还可以验证内容没有被篡改。

### JWT 的生成与验证

##### 组成  
  jwt便是一种基于token的认证方法，一个jwt字符串包括以下三个部分:头部(header)，载荷(payload)，签名(signature).

- header 
> 由两部分组成 token的类型（“JWT”）和算法名称（比如：HMAC SHA256或者RSA等等）。
```html
  
  {
    'alg': "HS256",
    'typ': "JWT"
}
  
 ```
 
 - payload 
 > 声明是关于实体(通常是用户)和其他数据的声明。声明有三种类型: registered, public 和 private。    
Registered claims : 这里有一组预定义的声明，它们不是强制的，但是推荐。比如：iss (issuer), exp (expiration time), sub (subject), aud (audience)等。    
Public claims : 可以随意定义。   
Private claims : 用于在同意使用它们的各方之间共享信息，并且不是注册的或公开的声明。   
 
 ```html
{
"sub": "1", //该JWT所面向的用户
"iss": "http://localhost:8000/auth/login", //该JWT的签发者 
"iat": , //iat(issued at): 在什么时候签发的token
"exp": , //exp(expires): token什么时候过期
"nbf": , //nbf(not before)：token在此时间之前不能被接收处理
"jti": "" //JWT ID为web token提供唯一标识
}
  ```
  
- Signature
> 为了得到签名部分，你必须有编码过的header、编码过的payload、一个秘钥，签名算法是header中指定的那个，然对它们签名即可。

```html
# 定义私有密钥
key = 'secretkey'

# header和payload拼接生成令牌
unsignedToken = encodeBase64(header) + '.' + encodeBase64(payload)

#生成签名
signature = HMAC-SHA256(key, unsignedToken)
```
- 最终生成jwt数据 当我们分别生成了头部，载荷，签名之后，我们就可以生成最终数据了。
> #最后拼接生成JWT      JWT = encodeBase64(header) + '.' + encodeBase64(payload) + '.' + encodeBase64(signature)
  
