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


func quick2(arr []int, left, right int) {
	if left >= right {
		return
	}
	// 设置一个参照值
	temp := arr[left]
	// 定义两个游标
	i, j := left, right
	for {
		// 从右边开始 找到第一个比参照值小的数
		for arr[j] >= temp && j > i {
			// 没找到 继续往左边找 ，当i j  想等 退出
			j--
		}
		// 从左向右找，找到第一个比参照值大的数
		for arr[i] <= temp && j > i {
			// 没找到 继续往右边找 ，当i j  想等 退出
			i++
		}
		// 如果 i >=j   说明没找到 ，退出，要么temp 最大 要么最小
		if i >= j {
			break
		}
		// 如果在中间有遇到 交换数据
		arr[i], arr[j] = arr[j], arr[i]
	}

	// 将 参照值移到游标相遇点
	arr[left] = arr[i]
	arr[i] = temp
	// 递归，左右两侧分别排序
	quickSort(arr, left, i-1)
	quickSort(arr, i+1, right)
}

