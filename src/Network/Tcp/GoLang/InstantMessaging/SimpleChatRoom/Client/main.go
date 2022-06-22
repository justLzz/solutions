package main

import (
	"fmt"
)

var account string
var password string
var  lookup = true
var  key int

func main()  {
	for  {
		fmt.Println("----------1，登录----------")
		fmt.Println("----------2，注册----------")
		fmt.Println("----------3，退出----------")
		fmt.Println("选择(1-3)")
		fmt.Scanf("%d\n", &key)
		switch key {
			case 1:
				fmt.Println("登录")
				lookup = false
			case 2:
				fmt.Println("注册")
				lookup = false
			case 3:
				fmt.Println("退出")
				lookup = false
			default:
				fmt.Println("位置操作")

		}
		if key == 1 {
			fmt.Println("登录")
			err := login(account, password)
			if err == nil {
				fmt.Println("登录成功")
			} else {
				fmt.Println("登录是失败")
			}
		}
	}
}