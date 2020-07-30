<?php


$a = [9, 5, 3, 8, 1, 7, 6, 4, 2];

$len = count($a);

for ($i = 1; $i < $len; $i++) {

    for ($j = $i; $j > 0 && $a[$j] < $a[$j - 1]; $j--) {
        $temp =$a[$j];
        $a[$j] = $a[$j-1];
        $a[$j-1] = $temp;
    }
}

print_r($a);
