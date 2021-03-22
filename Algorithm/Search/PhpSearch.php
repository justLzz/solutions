<?php


namespace Solutions\Algorithm\Search;


class PhpSearch
{
    //二分查找
    public function binarySearch($arr,$value)
    {
        $low = 0;
        $top = count($arr);
        while ($low <= $top)
        {
            $mid = floor(($top + $low) / 2);
            if ($arr[$mid] == $value)
            {
                return $mid;
            } else if ($arr[$mid] < $value)
            {
                $low = $mid + 1;
            } else {
                $top = $mid - 1;
            }
        }

    }
    //二分查找递归
    public function binarySearchRecursion(&$arr,$value,$low,$top)
    {

        if ($low <= $top)
        {
            $mid = floor(($low + $top) / 2);
            if ($arr[$mid] == $value)
            {
                return $mid;
            } else if ($arr[$mid] < $value) {
                return $this->binarySearchRecursion($arr, $value, $mid+1,$top);
            } else {
                return $this->binarySearchRecursion($arr, $value, $low,$mid-1);
            }
        } else {
            return -1;
        }

    }
}

$arr = [1,2,3,4,5,6,7,8,9,10,11,12,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29];
$sort = new PhpSearch();
//var_dump($sort->binarySearch($arr,17));
var_dump($sort->binarySearchRecursion($arr,17,0,sizeof($arr)));