    <?php

    function BubbleSort2($arr)
    {
        $len = count($arr);

         for ($i = 1; $i < $len; $i++) { //该层循环用来控制每轮 冒出一个数 需要比较的次数
                for ($k = 0; $k < $len - $i; $k++) {
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