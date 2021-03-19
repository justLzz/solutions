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

    //选择排序
    public function selectSort($arr)
    {
        //每一趟选择出最小或最大，
        for ($i=0;$i<count($arr);$i++)
        {
            $k=$i;//数组下标
            for ($j=$i+1;$j<count($arr);$j++)
            {
                //选最小,从小到大排序
                if ($arr[$j] < $arr[$k])
                {
                    $k=$j;
                }
            }
            //第i趟位置的元素和最小元素交换位置
            list($arr[$i], $arr[$k]) = [$arr[$k], $arr[$i]];
        }
        return $arr;
    }

    //插入排序
    public function insertSort($arr)
    {
        for ($i=1;$i<count($arr);$i++)
        {
            $j = $i - 1;
            $tmp = $arr[$i];
            while ($arr[$j] > $tmp)//从小到大
            {
                list($arr[$j],$arr[$j+1]) = [$arr[$j+1], $arr[$j]];//没找到就跟他的前位交换位置
                $j--;
            }
        }
        return $arr;
    }

    //快速排序
    public function quickSort($arr)
    {

        return $arr;
    }

}

$arr = [12,8,3,7,2,83,75,6,78,34,89,10,11];
$sort = new PhpSort();
var_dump($sort->insertSort($arr));


