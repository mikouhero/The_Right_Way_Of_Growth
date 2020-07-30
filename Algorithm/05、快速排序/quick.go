package main

import "fmt"

func main() {
	a := []int{9, 1, 5, 8, 3, 7, 6, 4, 2}
	d := quick(a)
	fmt.Println(d)
}

func quick(arr []int) []int {
	length := len(arr)
	if length <= 1 {
		return arr
	}

	base := arr[0]
	leftArray := []int{}
	rightArray := []int{}

	for i := 1; i < length; i++ {
		if (arr[i] < base) {
			leftArray = append(leftArray, arr[i])
		} else {
			rightArray = append(rightArray, arr[i])
		}
	}
	leftArray = quick(leftArray)
	rightArray = quick(rightArray)
	return append(append(leftArray, base), rightArray...)
}
