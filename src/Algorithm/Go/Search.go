package main

import "fmt"

func main()  {
	var arr = []int{2,7,11,15}
	var res = getCombinationWithSumFromOneSortArray(arr,  9)
	fmt.Println(res)
}
/**
 * 输入一个递增排序的数组和一个数字s，在数组中查找两个数，使得它们的和正好是s。
 * 如果有多对数字的和等于s，则输出任意一对即可。
 * 输入：nums = [2,7,11,15], target = 9
 * 输出：[2,7] 或者 [7,2]
 * @param arr [] int
 * @param sum int
 * @return array
 */
func getCombinationWithSumFromOneSortArray(arr []int, sum int) [2]int {
	left := 0
	right := len(arr) - 1
	for right > left {
		if (arr[right] + arr[left]) > sum {
			right--
		} else if (arr[right] + arr[left]) < sum {
			left++
		} else {
			arrRes := [2]int{left, right}
			return arrRes
		}
	}
	return [2]int{0,0}

}

