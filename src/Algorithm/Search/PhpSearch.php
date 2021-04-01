<?php


namespace Justlzz\Solutions\Algorithm\Search;


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