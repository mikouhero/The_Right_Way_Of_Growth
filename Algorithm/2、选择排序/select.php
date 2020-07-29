<?php

function select($a)
{

    $len = count($a);

    for ($i = 0; $i < $len; $i++) {
        $min = $i;
        for ($j = $i+1; $j < $len; $j++) {
            if ($a[$min] > $a[$j]) {
                $min = $j;
            }
        }
        if ($min != $i) {
            $tmp     = $a[$min];
            $a[$min] = $a[$i];
            $a[$i]   = $tmp;
        }
        print_r($a);

    }
}
