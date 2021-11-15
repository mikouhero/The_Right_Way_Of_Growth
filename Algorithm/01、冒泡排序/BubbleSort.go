package main

import "fmt"

func main() {
	arr := []int{4,5,6,3,2,1}
	sort(arr)
	BubbleSort3()
}

func sort(arr []int) []int{

	len := len(arr)
	if len<=1 {
		return arr
	}
	for i := 0; i < len; i++ {
		for j := 0; j < len-1; j++ {
			if arr[j] >arr[j+1] {
				arr[j], arr[j+1] = arr[j+1], arr[j]
			}
		}
	}
	return  arr
}

func BubbleSort1(arr []int) {

	len := len(arr)
	for i := 0; i < len; i++ {
		for j := 0; j < len; j++ {
			if arr[i] < arr[j] {
				arr[i], arr[j] = arr[j], arr[i]
			}
		}
	}
	fmt.Println(arr)
}

func BubbleSort2(arr []int) {
	len := len(arr)
	for i := 1; i < len; i++ {
		for j := 0; j < len-i-1; j++ {
			if arr[j] < arr[j+1] {
				arr[j], arr[j+1] = arr[j+1], arr[j]
			}
		}
	}
	fmt.Println(arr)
}

func BubbleSort3() {
	a := []int{2, 1, 3, 4, 5, 6, 7, 8, 9}

	length := len(a)

	for i := 0; i < length-1; i++ {
		flag := true
		for j := 0; j < length-1-i; j++ {

			if a[j] > a[j+1] {
				a[j], a[j+1] = a[j+1], a[j]
				flag = false
			}
		}
		if flag {
			break
		}
	}

	fmt.Println(a)
}
