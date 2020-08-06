package ArrayList

type StackArray interface {
	Clear()
	Size() int
	Pop() interface{}
	Push(data interface{})
	IsFull() bool
	IsEmpty() bool
}

type Stack struct {
	myarray *ArrayList
	capsize int
}

func NewArrayListStack() *Stack {
	stack := new(Stack)
	stack.myarray = NewArrayList()
	stack.capsize = 10
	return stack
}

func (mystack *Stack) Clear() {
	mystack.myarray.Clear()
	mystack.capsize = 10
}
func (mystack *Stack) Size() int {
	return mystack.myarray.TheSize
}
func (mystack *Stack) Pop() interface{} {
	if !mystack.IsEmpty() {
		last := mystack.myarray.DataStore[mystack.myarray.TheSize-1]
		mystack.myarray.Delete(mystack.myarray.TheSize - 1)
		return last
	}
	return nil
}
func (mystack *Stack) Push(data interface{}) {
	if !mystack.IsFull() {
		mystack.myarray.Append(data)
	}

}
func (mystack *Stack) IsFull() bool {
	return mystack.myarray.TheSize == mystack.capsize
}

func (mystack *Stack) IsEmpty() bool {
	return mystack.myarray.TheSize == 0
}
