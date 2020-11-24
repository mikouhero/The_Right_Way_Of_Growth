package main

import (
	"bufio"
	"flag"
	"fmt"
	"io"
	"os"
)

func main() {
	// 解析命令行参数
	flag.Parse()

	if flag.NArg() == 0 {
		cat(bufio.NewReader(os.Stdin))
	}

	for i := 0; i < flag.NArg(); i++ {
		fileName := flag.Arg(i)
		file, e := os.Open(fileName)
		if e != nil {
			fmt.Fprintf(os.Stdout, "reading from %s failed, err:%v\n", flag.Arg(i), e)
			continue
		}
		cat(bufio.NewReader(file))
	}
}

func cat(r *bufio.Reader) {
	for {
		bytes, e := r.ReadBytes('\n')
		if e != io.EOF {
			break
		}
		if e != nil {
			fmt.Fprintf(os.Stdout, "发生异常 %s", e)
		}

		fmt.Fprintf(os.Stdout, "%s", bytes)
	}
}
