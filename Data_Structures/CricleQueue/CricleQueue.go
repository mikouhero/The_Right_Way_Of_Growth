package CricleQueue

import "github.com/pkg/errors"

const QueueSize = 100

type CricleQueue struct {
	data  [QueueSize]interface{}
	front int // 头部的位置
	rear  int // 尾部的位置
}

func initQueue(q *CricleQueue) { // 初始化 头尾部重合 为空
	q.front = 0
	q.rear = 0
}

func QueueLength(q *CricleQueue) int {

	return (q.rear - q.front + QueueSize) % QueueSize
}

func EnQueue(q *CricleQueue, data interface{}) (err error) {
	if (q.rear+1)%QueueSize == q.front%QueueSize {
		return errors.New("队列已经满了")
	}
	q.data[q.rear] = data // 入队
	q.rear = (q.rear + 1) % QueueSize
	return nil

}

func DeQueue(q *CricleQueue) (data interface{}, err error) {

	if q.front == q.rear {
		return nil, errors.New("队列为空")
	}
	res := q.data[q.front] // 取出第一个数据
	q.data[q.front] = 0    // 清空数据
	q.front = (q.front + 1) % QueueSize
	return res, nil
}
