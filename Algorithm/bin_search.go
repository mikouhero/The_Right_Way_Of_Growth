import (
	"errors"
	"fmt"
)

func bin_serach(arr []int, findData int) (int ,error) {
	//http://www.topgoer.com
	low := 0
	high := len(arr) - 1
	for low <= high {
		mid := (low + high) / 2
		fmt.Println(mid)

		if arr[mid] >findData {
			high =  mid -1
		}else if arr[mid] < findData {
			low = mid + 1
		} else {
			return mid ,nil
		}
	}
	return -1,errors.New("未找到")

}
