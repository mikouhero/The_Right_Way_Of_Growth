<?php

$a =[0, 9, 1, 5, 8, 3, 7, 6, 4, 2];
shell($a);

function shell($arr)
{
    $len = count($arr);
    $gap = floor($len / 2);
    while ($gap > 0) {

        for ($i = $gap; $i < $len; $i++) {

            for ($j = $i; $j - $gap >= 0; $j -= $gap) {

                if ($arr[$j] < $arr[$j - $gap]) {
                    $temp    = $arr[$j];
                    $arr[$j] = $arr[$j - $gap];
                    $arr[$j - $gap] = $temp;
                }
            }
        }

        $gap = floor($gap / 2);
    }
    print_r($arr);
}
