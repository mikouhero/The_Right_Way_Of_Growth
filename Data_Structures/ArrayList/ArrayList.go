package ArrayList

import (
	"fmt"
	"github.com/pkg/errors"
)

type List interface {
	Size() int                                  // 数组大小
	Get(index int) (interface{}, error)         // 获取第几个元素
	Set(index int, newVal interface{}) error    // 修改数据
	Insert(index int, newVal interface{}) error // 插入数据
	Append(interface{})                         // 追加
	Clear()                                     // 清空
	Delete(index int) error                     //删除
	String() string                             // 返回字符串
}

// 数据结构 字符串 整数 实数
type ArrayList struct {
	DataStore []interface{} // 数组存储
	TheSize   int           // 数组大小
}

func NewArrayList() *ArrayList {
	list := new(ArrayList) // 初始化数据结构
	list.DataStore = make([]interface{}, 0, 10)
	list.TheSize = 0
	return list
}
func (list *ArrayList) checkIsFull() {
	if list.TheSize == cap(list.DataStore) {
		// fixme  第二个参数不能是 0 没有开辟空间
		newDataStore := make([]interface{}, 2*list.TheSize, 2*list.TheSize)
		copy(newDataStore, list.DataStore)
		// 等同于copy
		//for i:=0 ;i<len(list.DataStore);i++ {
		//	newDataStore[i] = list.DataStore[i]
		//}

		list.DataStore = newDataStore
	}
}

func (list *ArrayList) Size() int {
	return list.TheSize
}

func (list *ArrayList) Get(index int) (interface{}, error) {
	if index < 0 || index >= list.TheSize {
		return nil, errors.New("索引越界")
	}
	return list.DataStore[index], nil
}

func (list *ArrayList) Append(newVal interface{}) {
	list.checkIsFull()
	list.DataStore = append(list.DataStore, newVal)
	list.TheSize++
}

func (list *ArrayList) String() string {
	return fmt.Sprint(list.DataStore)
}

func (list *ArrayList) Set(index int, newVal interface{}) error {
	if index < 0 || index >= list.TheSize {
		return errors.New("索引越界")
	}
	list.DataStore[index] = newVal
	return nil
}

func (list *ArrayList) Insert(index int, newVal interface{}) error {
	if index < 0 || index >= list.TheSize {
		return errors.New("索引越界")
	}
	return nil
	list.checkIsFull()
	// 插入数据 内存移动一位
	list.DataStore = list.DataStore[:list.TheSize+1]
	for i := list.TheSize; list.TheSize > i; i-- {
		list.DataStore[i] = list.DataStore[i-1]
	}

	list.TheSize++
	return  nil
}

func (list *ArrayList) Clear() {
	list.DataStore = make([]interface{}, 0, 10)
	list.TheSize = 0
}

func (list *ArrayList) Delete(index int) error {
	list.DataStore = append(list.DataStore[:index], list.DataStore[index+1:]...)
	list.TheSize--
	return nil
}
