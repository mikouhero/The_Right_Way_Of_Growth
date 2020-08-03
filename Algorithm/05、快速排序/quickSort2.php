$a = [5, 9, 8, 7, 6, 4, 3, 2, 1];

quick($a,0,8);
print_r($a);

function quick(&$a, $left, $right)
{
    if ($left >= $right) {
        return;
    }

    // 参照值
    $temp = $a[$left];
    // 指针游标
    $i = $left;
    $j = $right;

    while ($i < $j) {

        // 从右边开始，找到第一个比参照值小的数
        while ($j > $i && $a[$j] >= $temp) {
            $j--;
        }


        // 从左边开始，找到第一个比参照值大的数
        while ($j > $i && $a[$i] <= $temp) {
            $i++;
        }

        // 如果没找到 说明参照值是最大或者最小
        if ($i >= $j) {
            break;
        }
        // 找到了  i j 互换
        $t     = $a[$i];
        $a[$i] = $a[$j];
        $a[$j] = $t;
    }

    // 将 参照值移到游标相遇点, 参照值与游标值互换位置

//    print_r($a);

    $a[$left] = $a[$i];
    $a[$i]    = $temp;
//    print_r($a);
    quick($a, $left, $i - 1);
    quick($a, $i + 1, $right);

}
