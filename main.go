package main

import (
	"wyblog/internal/dao/db"
	"wyblog/routes"
)

func main() {
	//引用数据库
	db.InitDb()

	//初始化路由
	routes.InitRouter()
}
