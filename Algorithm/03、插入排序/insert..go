package main

import "fmt"

func main() {
	insert()
}

func insert() {
	//a := []int{9, 1, 5, 8, 3, 7, 6, 4, 2}
	a := []int{9,8,7,6,5,4,3,2,1}

	length := len(a)

	for i := 1; i < length; i++ {
		for j := i; j > 0 && a[j] < a[j-1]; j-- {
			a[j], a[j-1] = a[j-1], a[j]
			fmt.Println("j 的值", j, a)
		}
		fmt.Println("外循环 i",i)
	}

}
