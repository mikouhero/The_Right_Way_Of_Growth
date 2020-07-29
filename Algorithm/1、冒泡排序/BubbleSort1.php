<?php

function BubbleSort1($array)
{
    $len = count($array);

    for ( $i=0; $i<$len; $i++ ) {

          for($j=$i+1;$j<$len;$j++) {
              // 将第一个数 与后面的每个数做比较，若第一个数大于后面某个，交换位置，循环继续操作
              // 缺点，在第一次外循环和内循环结束时，已经确定第一个数是最小，但是对后续数没影响
                if($array[$i] > $array[$j]) {
                    $temp = $array[$i];
                    $array[$i] = $array[$j];
                    $array[$j] = $temp;
                }
          }
    }
    return $array;
}

$array = [9,1,5,8,3,7,6,4,2];

$array =BubbleSort1($array);
var_dump($array);
