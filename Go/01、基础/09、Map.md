# map 


- 定义 

``` golang
map[KeyType] ValueType
- eyType:表示键的类型。
- ValueType:表示键对应的值的类型。
```

- 判断键是否存在
```golang
value, ok := map[key] 
```

- 使用delete() 删除键值对

```golang
     delete(map, key)
```

- 练习题
``` golang
func main() {
	type Map map[string][]int
	m := make(Map)
	s := []int{1, 2}
	s = append(s, 3)
	fmt.Printf("%+v\n", s)  // 1 2 3
	m["q1mi"] = s
	s = append(s[:1], s[2:]...)
	fmt.Printf("%+v\n", s)  //1 ,3  // 修改了底层数组
	fmt.Printf("%+v\n", m["q1mi"]) 1,3,3  
}

```
