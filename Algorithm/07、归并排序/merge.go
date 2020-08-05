package main

import "fmt"

func main() {
	array := []int{5, 9, 8, 7, 6, 4, 3, 2, 1}
	fmt.Println(array)
	array =	mergeSort(array)
	fmt.Println(array)

}

func mergeSort(array []int) []int {
	length := len(array)
	if length < 2 {
		return array
	}
	mid := length / 2
	left := mergeSort(array[:mid])
	right := mergeSort(array[mid:])

	return merge(left, right)
}

func merge(left, right []int) (result []int) {
	i, j := 0, 0
	for i < len(left) && j < len(right) {
		if left[i] < right[j] {
			result = append(result, left[i])
			i++
		} else {
			result = append(result, right[j])
			j++
		}
	}

	result = append(result, left[i:]...)
	result = append(result, right[j:]...)
	return
}
