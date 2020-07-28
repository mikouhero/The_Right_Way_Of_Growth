    <?php

    function BubbleSort2($array)
    {
        $len = count($array);

        for ( $i=1; $i<$len; $i++ ) {
              for($j=$len-1;$j>=$i;$j--) {  // 注意 j 是从后往前循环
                  if($array[$j] > $array[$j+1]) {  // 如果前者者大于后者
                      $temp = $array[$i];
                      $array[$i] = $array[$j];
                      $array[$j] = $temp;
                  }
              }
        }
        return $array;
    }

    $array = [9,1,5,8,3,7,6,4,2];

    $array =BubbleSort2($array);
    print_r($array);