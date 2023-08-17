<?php


namespace Justlzz\Solutions\Algorithm\Php\Search;


class Search
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

    /**
     * 随机取一算法，源于一道找猴子大王的算法题
     * 一群猴子排成一圈，按1，2，…，n依次编号。然后从第1只开始数，
     * 数到第m只,把它踢出圈，从它后面再开始数，再数到第m只，在把它踢出去…，
     * 如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。
     * @param $m
     * @param $n
     * @return int
     */
    public function takeOneAtRandom($m, $n)
    {
        //整体思路：一群猴子排成一队，如果符合条件就剔除，否则排在对尾继续排队
        $arr = range(1, $n); //排成一队
        $i = 0; //索引
        while (count($arr) > 1)
        {
            if (($i+1)%$m == 0)
            {
                unset($arr[$i]);
            } else {
                array_push($arr,$arr[$i]);
                unset($arr[$i]);
            }
            $i++;
        }
        return current($arr);
    }

    /**
     * 输入一个递增排序的数组和一个数字s，在数组中查找两个数，使得它们的和正好是s。
     * 如果有多对数字的和等于s，则输出任意一对即可。
     * 输入：nums = [2,7,11,15], target = 9
     * 输出：[2,7] 或者 [7,2]
     * @param $arr
     * @param $sum
     * @return array
     */
    public function getCombinationWithSumFromOneSortArray($arr, $sum)
    {
        //定义两个指针
        $left = 0; //头指针
        $right = count($arr) - 1; //尾指针

        while ($right > $left)
        {
            if (($arr[$left] + $arr[$right]) > $sum)
            {
                $right--;
            } else if (($arr[$left] + $arr[$right]) < $sum)
            {
                $left++;
            }else{
                return [$left, $right];
            }
        }
    }

}