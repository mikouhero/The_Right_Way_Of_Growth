package main

import "fmt"

func main() {
	array := []int{5, 9, 8, 7, 6, 4, 3, 2, 1}
	shell(array)
	fmt.Println(array)
}

func shell(array []int) {
	length := len(array)
	gap := length / 2
	for gap > 0 {

		for i := gap; i < length; i++ {

			for j := i; j-gap >= 0; j -= gap {
				if array[j] < array[j-gap] {
					array[j], array[j-gap] = array[j-gap], array[j]
				}
			}
		}

		gap /= 2
	}

}
