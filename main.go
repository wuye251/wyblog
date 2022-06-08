package main

import (
	"wyblog/model"
	"wyblog/routes"
)

func main() {
	//引用数据库
	model.InitDb()

	//初始化路由
	routes.InitRouter()
}
