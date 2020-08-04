<?php


$a = [0, 9, 1, 5, 8, 3, 7, 6, 4, 2];


$d = merge($a);

function merge($arr)
{
    $len = count($arr);
    if ($len < 2) {
        return $arr;
    }
    $middle = floor($len / 2);
    $left   = array_slice($arr, 0, $middle);
    $right  = array_slice($arr, $middle);

    return mergeArr(merge($left), merge($right));

}

function mergeArr($left, $right)
{


    $result = [];

    while (count($left) > 0 && count($right) > 0) {
        if ($left[0] <= $right[0]) {
            $result[] = array_shift($left);
        } else {
            $result[] = array_shift($right);
        }
    }

    while (count($left)) {
        $result[] = array_shift($left);
    }
    while (count($right)) {
        $result[] = array_shift($right);
    }
//    echo implode(',', $result) . PHP_EOL; // 完成一次增量输出一次结果

    return $result;
}
