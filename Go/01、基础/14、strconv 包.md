# 14 strconv 包

## string  与 int 类型转换

- Atoi()    
func Atoi(s string) (i int, err error)    
于将字符串类型的整数转换为int类型       

- Itoa()        
func Itoa(i int) string      
于将int类型数据转换为对应的字符串表示

- a 的典故     
【扩展阅读】这是C语言遗留下的典故。C语言中没有string类型而是用字符数组(array)表示字符串，所以Itoa对很多C系的程序员很好理解。

## Parse 系列函数
- ParseBool()       
func ParseBool(str string) (value bool, err error)      
返回字符串表示的bool值。它接受1、0、t、f、T、F、true、false、True、False、TRUE、FALSE；否则返回错误。       

- ParseInt()    
func ParseInt(s string, base int, bitSize int) (i int64, err error)     

- ParseUint()

- ParseFloat()




## Format系列函数

- func FormatBool(b bool) string

- func FormatInt(i int64, base int) string

- func FormatUint(i uint64, base int) string

- func FormatFloat(f float64, fmt byte, prec, bitSize int) string
