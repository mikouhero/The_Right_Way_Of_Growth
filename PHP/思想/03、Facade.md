# Facade  门面/外观模式

> 在 `Illuminate\Support\Facades` 下 都多个实例，以 Route 为例子

```php 
    class Route extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'router';
    }
}
```
```php 
 class Facade
 {
     
      public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();
        if (! $instance) {
            throw new RuntimeException('A facade root has not been set.');
        }
        return $instance->$method(...$args);
    }
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }
    protected static function getFacadeAccessor()
    {
        throw new RuntimeException('Facade does not implement getFacadeAccessor method.');
    }
    protected static function resolveFacadeInstance($name)
    {
        if (is_object($name)) {
            return $name;
        }
        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }
        return static::$resolvedInstance[$name] = static::$app[$name];
    }
    
 }  
```

>  每个门面类也就是重定义一下getFacadeAccessor函数就行 了，这个函数返回服务的唯一名称：router  。 `static::` 转发调用

> 使用Route::get() 时，触发 基类的__callStatic 方法 
> 基类getFacadeRoot()调用了getFacadeAccessor()，也就是我们的服 务重载的函数，如果调用了基类的getFacadeAccessor，就会抛出异常。在我们的 例子里getFacadeAccessor()返回了“router”，接下来getFacadeRoot()又调用了 resolveFacadeInstance()。在这个函数里重点就是`
 return static::$resolvedInstance[$name] = static::$app[$name];
`


