<?php


function bubble3()
{
    $a = [2, 1, 4, 3, 5, 6, 7, 8, 9];
//    $a = [9, 1, 5, 8, 3, 7, 6, 4, 2];
//    $a=[1,4,0,5,6,2,3];


    $len = count($a);
        
    for ($i = 0; $i < $len - 1; $i++) {
        $flag = true;
        for ($j = 0; $j < $len -$i- 1; $j++) {

            if ($a[$j] > $a[$j + 1]) {
                $tmp       = $a[$j];
                $a[$j]     = $a[$j + 1];
                $a[$j + 1] = $tmp;
                $flag = false;
            }
        }
        if($flag) {
            break;
        }
    }
    
    print_r($a);
}
