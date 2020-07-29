package main

import "fmt"

func main()  {
	selectSort()
}


func selectSort() {
	a := []int{9, 1, 5, 8, 3, 7, 6, 4, 2}
	length := len(a)
	for i := 0; i < length; i++ {
		min := i
		for j := i + 1; j < length; j++ {
			if a[min] > a[j] {
				min = j
			}
		}
		if min != i {
			a[min], a[i] = a[i], a[min]
		}
		fmt.Println(a)
	}
}
