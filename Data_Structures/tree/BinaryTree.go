package main

import (
	"fmt"
)

type Node struct {
	Data  int
	Left  *Node
	Right *Node
}

type BinaryTree struct {
	Root *Node
	Size int
}

func NewBinaryTree() *BinaryTree {
	bst := &BinaryTree{
		Root: nil,
		Size: 0,
	}
	return bst
}

func (bst *BinaryTree) GetSize() int {
	return bst.Size
}

func (bst *BinaryTree) IsEmpty() bool {
	return bst.Size == 0
}

func (bst *BinaryTree) Add(data int) {
	bst.Root = bst.add(bst.Root, data)
}

func (bst *BinaryTree) add(n *Node, data int) *Node {
	if n == nil { // 根节点
		bst.Size++
		return &Node{
			Data:  data,
			Left:  nil,
			Right: nil,
		}
	} else {
		if data < n.Data {
			n.Left = bst.add(n.Left, data)
		} else {
			n.Right = bst.add(n.Right, data)
		}
	}
	return n
}

func (bst *BinaryTree) IsIn(data int) bool {
	return bst.isin(bst.Root, data)
}

func (bst *BinaryTree) isin(n *Node, data int) bool {
	if n == nil {
		return false // 空树
	}

	if data == n.Data {
		return true
	} else if data < n.Data {
		return bst.isin(n.Left, data)

	} else {
		return bst.isin(n.Right, data)
	}
}

func (bst *BinaryTree) FindMax() int {
	if bst.Size == 0 {
		panic("空树")
	}
	return bst.findmax(bst.Root).Data
}

func (bst *BinaryTree) findmax(n *Node) *Node {
	if n.Right == nil {
		return n
	} else {
		return bst.findmax(n.Right)
	}
}
func (bst *BinaryTree) FindMix() int {
	if bst.Size == 0 {
		panic("空树")
	}
	return bst.findmix(bst.Root).Data
}

func (bst *BinaryTree) findmix(n *Node) *Node {
	if n.Left == nil {
		return n
	} else {
		return bst.findmix(n.Left)
	}
}

func (bst *BinaryTree) PreOrder() {
	bst.preorder(bst.Root)
}

func (bst *BinaryTree) preorder(node *Node) {
	if node == nil {
		return
	}

	fmt.Println(node.Data)
	bst.preorder(node.Left)
	bst.preorder(node.Right)
}

func (bst *BinaryTree) InOrder() {
	bst.inorder(bst.Root)
}

func (bst *BinaryTree) inorder(node *Node) {
	if node == nil {
		return
	}

	bst.inorder(node.Left)
	fmt.Println(node.Data)
	bst.inorder(node.Right)
}

func (bst *BinaryTree) PostOrder() {
	bst.postorder(bst.Root)
}

func (bst *BinaryTree) postorder(node *Node) {
	if node == nil {
		return
	}

	bst.postorder(node.Left)
	bst.postorder(node.Right)
	fmt.Println(node.Data)

}

func (bst *BinaryTree) RemoveMin() int {
	ret := bst.FindMix()
	bst.Root = bst.removemin(bst.Root)
	return ret
}

func (bst *BinaryTree) removemin(n *Node) *Node {
	if n.Left == nil {
		//删除
		rightNode := n.Right // 备份右边的节点
		bst.Size--
		return rightNode
	}
	n.Left = bst.removemin(n.Left)
	return n
}

func (bst *BinaryTree) RemoveMax() int {
	ret := bst.FindMax()
	bst.Root = bst.removemax(bst.Root)
	return ret
}

func (bst *BinaryTree) removemax(n *Node) *Node {
	if n.Right == nil {
		//删除
		leftNode := n.Left // 备份左边边的节点
		bst.Size--
		return leftNode
	}
	n.Right = bst.removemin(n.Right)
	return n
}

func (bst *BinaryTree) Remove(data int) {
	bst.Root = bst.remove(bst.Root, data)
}

func (bst *BinaryTree) remove(n *Node, data int) *Node {

	if n == nil {
		return nil
	}
	if data < n.Data {
		n.Left = bst.remove(n.Left, data)
		return n
	} else if data > n.Data {

		n.Right = bst.remove(n.Right, data)
		return n
	} else {
		if n.Left == nil {
			rightNode := n.Right // 备份右边节点
			n.Right = nil        // 处理节点返回
			bst.Size--           // 删除
			return rightNode
		}
		if n.Right == nil {
			leftNode := n.Left
			n.Left = nil
			bst.Size--
			return leftNode
		}

		// 左右都不为空

		oknode := bst.findmix(n.Right)
		oknode.Right = bst.removemin(n.Right)
		oknode.Left = n.Left

		n.Left = nil
		n.Right = nil
		return oknode

	}
}

func main() {
	bst := NewBinaryTree()
	bst.Size = 7
	node1 := &Node{4, nil, nil}
	node2 := &Node{2, nil, nil}
	node3 := &Node{6, nil, nil}
	node4 := &Node{1, nil, nil}
	node5 := &Node{3, nil, nil}
	node6 := &Node{5, nil, nil}
	node7 := &Node{7, nil, nil}
	bst.Root = node1
	node1.Left = node2
	node1.Right = node3
	node2.Left = node4
	node2.Right = node5
	node3.Left = node6
	node3.Right = node7
	/*
				4
			2 	  6
		1    3  5   7
	*/

	//bst.PreOrder()	// 4 2 1 3 6 5 7
	//bst.PostOrder()  // 1 3 2 5 7 6 4
	//bst.InOrder()  // 1 2 3 4 5 6 7

	//removemin := bst.RemoveMin()
	//fmt.Println("min",removemin)
	//bst.InOrder()

}
