<?php


function bubble3()
{
    $a = [2, 1, 3, 4, 5, 6, 7, 8, 9];
//    $a = [9, 1, 5, 8, 3, 7, 6, 4, 2];
//    $a=[1,4,0,5,6,2,3];


    $len = count($a);
        
    for ($i = 0; $i < $len - 1; $i++) {
        $flag = true;  // 默认排序已完成
        for ($j = 0; $j < $len -$i- 1; $j++) {
            if ($a[$j] > $a[$j + 1]) {  // 一旦有数据进来 说明数据不是有序的，改变标识 ，如果不满足条件 说明 有序
                $tmp       = $a[$j];
                $a[$j]     = $a[$j + 1];
                $a[$j + 1] = $tmp;
                $flag = false;
            }
        }
        if($flag) {// 当排序完成时，跳出循环
            break;
        }
    }
    
    print_r($a);
}
