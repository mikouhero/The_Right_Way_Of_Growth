package Queue

type MyQueue interface {
	Size() int
	Front() interface{}
	End() interface{}
	IsEmpty() bool
	EnQueue(data interface{}) // 入队
	DeQueue() interface{}     // 出队
	Clear()
}

type Queue struct {
	dataScore []interface{}
	theSize   int
}

func NewQueue() *Queue {
	myqueue := new(Queue)
	myqueue.dataScore = make([]interface{}, 0)
	myqueue.theSize = 0
	return myqueue
}

func (myq *Queue) Size() int {
	return myq.theSize
}
func (myq *Queue) Front() interface{} {
	if myq.theSize == 0 {
		return nil
	}
	return myq.dataScore[0]
}
func (myq *Queue) End() interface{} {
	if myq.theSize == 0 {
		return nil
	}
	return myq.dataScore[myq.theSize-1]
}
func (myq *Queue) IsEmpty() bool {
	return myq.theSize == 0
}
func (myq *Queue) EnQueue(data interface{}) {

	myq.dataScore = append(myq.dataScore, data)
	myq.theSize++

}

func (myq *Queue) DeQueue() interface{} {
	if myq.theSize == 0 {
		return nil
	}
	data := myq.dataScore[0]

	if myq.theSize > 1 {
		myq.dataScore = myq.dataScore[1:]
	} else {
		myq.dataScore = make([]interface{}, 0)
	}
	myq.theSize--
	return data
}

func (myq *Queue) Clear() {
	myq.theSize = 0
	myq.dataScore = make([]interface{}, 0)
}
