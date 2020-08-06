package main

import (
	"./ArrayList"
	"./StackArray"
	"fmt"
)

func main()  {
	mystack := StackArray.NewStack()
	mystack.Push(1)
	mystack.Push(2)
	mystack.Push(3)
	mystack.Push(4)
	fmt.Println(mystack.Size())
	fmt.Println(mystack.IsFull())
	fmt.Println(mystack.IsEmpty())
	fmt.Println(mystack.Pop())
	fmt.Println(mystack.Pop())



}
func main3() {
	list := ArrayList.NewArrayList()

	list.Append(1)
	list.Append(2)
	list.Append(3)
	list.Append(4)
	list.Append(5)
	list.Append(6)

	for it := list.Iterator();it.HasNext();{
		fmt.Println(it.Next())
	}
}

func main2()  {
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