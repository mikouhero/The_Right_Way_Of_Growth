package main

import (
	"errors"
	"fmt"
	"io/ioutil"
	"os"
	"reflect"
	"strconv"
	"strings"
)

type MySqlConfig struct {
	Address  string `ini:"address"`
	Port     int    `ini:"port"`
	Username string `ini:"username"`
	Password string `ini:"password"`
}

type RedisConfig struct {
	Host     string `ini:"host"`
	Port     int    `ini:"port"`
	Password string `ini:"password"`
	Database int    `ini:"database"`
}

type Config struct {
	MySqlConfig `ini:"mysql"`
	RedisConfig `ini:"redis"`
}

func loadIni(filename string, data interface{}) (err error) {

	t := reflect.TypeOf(data)
	/// 传进来的data参数必须是指针
	if t.Kind() != reflect.Ptr {
		err = errors.New("data 数据类型必须是指针")
		return
	}
	// 传进来的data 参数必须是结构体指针类型
	if t.Elem().Kind() != reflect.Struct {
		err = errors.New("data 数据类型必须是结构体指针")
		return
	}

	// 读文件得到字节类型
	bytes, err := ioutil.ReadFile(filename)
	if err != nil {
		return
	}
	lineSlice := strings.Split(string(bytes), "\r\n")

	var structName string
	for idx, line := range lineSlice {

		// 去掉首尾的空格
		line = strings.TrimSpace(line)

		// 去除空行
		if len(line) == 0 {
			continue
		}
		// 如果是注释就跳过
		if strings.HasPrefix(line, ";") || strings.HasPrefix(line, "#") {
			continue
		}

		// 如果是 [ 开头就 表示节
		if strings.HasPrefix(line, "[") {
			if line[0] != '[' || line[len(line)-1] != ']' {
				err = fmt.Errorf("第%d行语法错误", idx+1)
				return
			}

			// 吧这一行首尾的 [] 去掉 ，拿到中间的内容
			selectName := strings.TrimSpace(line[1 : len(line)-1])

			if len(selectName) == 0 {
				err = fmt.Errorf("第%d行语法错误", idx+1)
				return
			}

			// 更加字符串selectName的data 里面根据反射找到对应的结构体
			for i := 0; i < t.Elem().NumField(); i++ {
				field := t.Elem().Field(i)
				if selectName == field.Tag.Get("ini") {
					// 说明找到了对应的嵌套结构体 把字段名记下来
					structName = field.Name
					//fmt.Printf("找到了%s对应的嵌套结构体%s\r\n", selectName, structName)
				}
			}

		} else {

			// 用等号分割键值对  左边 key  右边 val

			if strings.Index(line, "=") == -1 || strings.HasPrefix(line, "=") {
				fmt.Printf("第%d行数据忽略\n", idx+1)
				continue
			}

			// 等号所在的位置
			index := strings.Index(line, "=")
			key := strings.TrimSpace(line[:index])
			value := strings.TrimSpace(line[index+1:])

			// 根据structName 在data 里面吧结构体取出去
			v := reflect.ValueOf(data)
			sValue := v.Elem().FieldByName(structName) // 拿到嵌套结构体的值信息
			sType := sValue.Type()                     //拿到嵌套结构体的类型信息
			if sType.Kind() != reflect.Struct {
				err = fmt.Errorf("data 中的%s字段应该是一个结构体", structName)
				return
			}
			var fieldName string
			var fieldType reflect.StructField
			//  遍历嵌结构体的每一个字段 判断tag 是否是key
			for i := 0; i < sType.NumField(); i++ {
				field := sType.Field(i) // tag 信息存储在类型信息中的
				fieldType = field
				if field.Tag.Get("ini") == key {
					// 找到了对应的字段
					fieldName = field.Name
					break
				}

			}

			if len(fieldName) == 0 {
				// 在结构体找不到对应的字段
				continue
			}
			//根据fieldName  取出这个字段
			fieldObj := sValue.FieldByName(fieldName)
			fmt.Println(fieldName, fieldType.Type.Kind())

			switch fieldType.Type.Kind() {
			case reflect.String:
				fieldObj.SetString(value)
			case reflect.Int, reflect.Int8, reflect.Int16, reflect.Int32, reflect.Int64:
				valueInt, err := strconv.ParseInt(value, 10, 64)
				if err != nil {
					return fmt.Errorf("第%d行格式解析错误"+err.Error(), idx+1)
				}
				fieldObj.SetInt(valueInt)
			case reflect.Bool:
				valueBool, err := strconv.ParseBool(value)
				if err != nil {
					return fmt.Errorf("第%d行格式解析错误"+err.Error(), idx+1)
				}
				fieldObj.SetBool(valueBool)
			case reflect.Float32, reflect.Float64:
				valueFloat, err := strconv.ParseFloat(value, 64)
				if err != nil {
					return fmt.Errorf("第%d行格式解析错误"+err.Error(), idx+1)
				}
				fieldObj.SetFloat(valueFloat)

			}

		}

	}
	return
}

func main() {
	var config Config
	dir, _ := os.Getwd()
	err := loadIni(dir+"/demo/readini/config.ini", &config)
	fmt.Println(err)
	fmt.Printf("%#v", config)
}
