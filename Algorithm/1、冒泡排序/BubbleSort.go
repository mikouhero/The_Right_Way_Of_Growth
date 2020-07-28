package main

import "fmt"

func main()  {
	arr:=[]int{3,4,5,1,2,7,6,9,8}
	BubbleSort1(arr)
	BubbleSort2(arr)

}


func BubbleSort1( arr []int){

	len := len(arr)
	for i:=0;i<len ;i++  {
		for j:=0;j<len ;j++  {
			if arr[i] < arr[j] {
				arr[i],arr[j] = arr[j],arr[i]
			}
		}
	}
	fmt.Println(arr)
}

func BubbleSort2(arr []int)  {
	len := len(arr)
	for i:=1;i<len ;i++  {
		for j:=0;j<len-i ;j++  {
			if arr[j] < arr[j+1] {
				arr[j],arr[j+1] = arr[j],arr[j+1]
			}
		}
	}
	fmt.Println(arr)
}