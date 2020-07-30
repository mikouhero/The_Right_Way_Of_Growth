<?php 

$a = [9, 5, 3, 8, 1, 7, 6, 4, 2];


function quickSort($a)
{
  $len = count($a);
  if ($len < =1) return $a;
  
  // 定义一个基准数
  $key = $a[0];
  // 比基准数不大的集合
  $leftArray = [];
  //比基准数大的集合
  $rightArray = [];
  
  for ($i =1; $i<$len;$i++) {
      
        if($a[$i] > $key) {
        
          $rightArray[] = $a[$i];
        }else{
          $leftArray[] = $a[$i];
        }
  
  }
  
    $leftArray = quickSort($leftArray);
    $rightArray = quickSort($rightArray);

return array_merge($leftArray,[$key],$rightArray);
  
}
