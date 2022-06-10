package routes

import (
	v1 "wyblog/api/v1"
	"wyblog/utils"

	"github.com/gin-gonic/gin"
)

func InitRouter() {
	gin.SetMode(utils.AppMode)
	r := gin.Default()

	routerV1 := r.Group("api/v1")
	{
		//用户模块路由接口
		routerV1.POST("user/add", v1.AddUser)
		routerV1.DELETE("user/:id", v1.DeleteUser)
		routerV1.PUT("user/:id", v1.UpdateUser)
		routerV1.GET("user/:id", v1.GetUser)
		routerV1.GET("user/list", v1.GetUsers)
		routerV1.GET("user/check", v1.CheckUserExist)
		//分类模块路由接口
		routerV1.POST("category/add", v1.AddCategory)
		routerV1.DELETE("category/:id", v1.DeleteCategory)
		routerV1.PUT("category/:id", v1.UpdateCategory)
		routerV1.GET("category/list", v1.GetCategories)

		//文章模块路由接口
		routerV1.POST("article/add", v1.AddArticle)
		routerV1.DELETE("article/:id", v1.DeleteArticle)
		routerV1.PUT("article/:id", v1.UpdateArticle)

	}

	r.Run((utils.HttpPort))
}
