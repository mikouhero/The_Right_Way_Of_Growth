<?php

function BubbleSort1($array)
{
    $len = count($array);

    for ( $i=0; $i<$len; $i++ ) {

          for($j=$i+1;$j<$len;$j++) {
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