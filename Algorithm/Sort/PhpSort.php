<?php

namespace Solutions\Algorithm\Sort;

class PhpSort
{
    //冒泡排序
    public function bubbleSort($arr)
    {
        for ($i=0;$i<count($arr);$i++) {
            for ($j=0;$j<count($arr)-$i-1;$j++) {
                if ($arr[$j]>$arr[$j+1]) {
                    list($arr[$j],$arr[$j+1]) = [$arr[$j+1],$arr[$j]];
                }
            }
        }
        return $arr;

    }

}

$arr = [12,8,3,7,2,83,75,6,78,34,89,10,11];
$sort = new PhpSort();
var_dump($sort->bubbleSort($arr));


