    <?php

    function BubbleSort2($arr)
    {
        $len = count($arr);

         for ($0 = 1; $i < $len; $i++) { //该层循环用来控制每轮 冒出一个数 需要比较的次数
                // $k = 0; $k < $len -1; $k++  简化版  将最大的数沉下去 ，比较相邻数，大的沉下去 
                // $k = 0; $k < $len -1 - $i; $k++  // 由于已经将最大的数沉下去了，所以外部循环不必每次都比较固定长度，而是循环比较len - i 的数据
                for ($k = 0; $k < $len -1 - $i; $k++) {
                    if ($arr[$k] > $arr[$k + 1]) {
                        $tmp = $arr[$k + 1];
                        $arr[$k + 1] = $arr[$k];
                        $arr[$k] = $tmp;
                    }
                }
            }
        return $arr;
    }

    $array = [9,1,5,8,3,7,6,4,2];

    $array =BubbleSort2($array);
    print_r($array);
