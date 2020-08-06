package StackArray

type StackArray interface {
	Clear()
	Size() int
	Pop() interface{}
	Push(data interface{})
	IsFull() bool
	IsEmpty() bool
}

type Stack struct {
	datasource  []interface{}
	capsize     int
	currentsize int
}

func NewStack() *Stack {
	stack := new(Stack)
	stack.datasource = make([]interface{}, 0, 10)
	stack.capsize = 10
	stack.currentsize = 0
	return stack
}

func (mystack *Stack) Clear() {
	mystack.datasource = make([]interface{}, 0, 10)
	mystack.capsize = 10
	mystack.currentsize = 0
}
func (mystack *Stack) Size() int {
	return mystack.currentsize
}
func (mystack *Stack) Pop() interface{} {
	if !mystack.IsEmpty() {
		last := mystack.datasource[mystack.currentsize-1]
		mystack.datasource = mystack.datasource[:mystack.currentsize-1]
		mystack.currentsize--
		return last
	}
	return nil
}
func (mystack *Stack) Push(data interface{}) {
	if !mystack.IsFull() {
		mystack.datasource = append(mystack.datasource, data)
		mystack.currentsize++
	}

}
func (mystack *Stack) IsFull() bool {
	return mystack.currentsize == mystack.capsize
}

func (mystack *Stack) IsEmpty() bool {
	return mystack.currentsize == 0
}
