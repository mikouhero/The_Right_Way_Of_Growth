package main

import (
	"./ArrayList"
	"fmt"
)

func main()  {
	list := ArrayList.NewArrayList()
	list.Append(1)
	list.Append(2)
	list.Append(3)
	list.Append(4)
	list.Append(5)
	list.Append(6)
	fmt.Println(list.String())
	fmt.Println(list.Get(1))
	fmt.Println(list.Set(1,23))
	fmt.Println(list.String())

}