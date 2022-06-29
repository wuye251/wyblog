package routes

import (
	v1 "wyblog/api/v1"
	"wyblog/middleware"
	"wyblog/utils"

	"github.com/gin-contrib/multitemplate"
	"github.com/gin-gonic/gin"
)

func createMyRender() multitemplate.Renderer {
	p := multitemplate.NewRenderer()
	p.AddFromFiles("admin", "./web/admin/dist/index.html")
	p.AddFromFiles("front", "./web/front/dist/index.html")
	return p
}

func InitRouter() {
	gin.SetMode(utils.AppMode)
	r := gin.New()
	r.HTMLRender = createMyRender()
	r.Use(middleware.Logger())
	r.Use(gin.Recovery())
	r.Use(middleware.Cors())

	r.Static("/front", "./web/front/dist")
	r.Static("/admin", "./web/admin/dist")
	r.StaticFile("/favicon.ico", "./web/front/dist/favicon.ico")
	// r.StaticFile("/admin.js", "./web/admin/dist/config.js")
	// r.StaticFile("/front.js", "./web/front/dist/config.js")
	r.StaticFile("/config.js", "./web/admin/dist/config.js")

	r.GET("/", func(c *gin.Context) {
		c.HTML(200, "front", nil)
	})

	r.GET("/admin", func(c *gin.Context) {
		c.HTML(200, "admin", nil)
	})

	auth := r.Group("api/v1")
	auth.Use(middleware.JwtToken())
	{
		//用户模块路由接口
		auth.POST("user/add", v1.AddUser)
		auth.DELETE("user/:id", v1.DeleteUser)
		auth.PUT("user/:id", v1.UpdateUser)
		//分类模块路由接口
		auth.POST("category/add", v1.AddCategory)
		auth.DELETE("category/:id", v1.DeleteCategory)
		auth.PUT("category/:id", v1.UpdateCategory)

		//文章模块路由接口
		auth.POST("article/add", v1.AddArticle)
		auth.DELETE("article/:id", v1.DeleteArticle)
		auth.PUT("article/:id", v1.UpdateArticle)

		//上传文件
		auth.POST("upload", v1.Upload)
	}

	routerV1 := r.Group("api/v1")
	{
		//用户模块路由接口
		routerV1.GET("user/list", v1.GetUsers)
		routerV1.GET("user/:id", v1.GetUserInfo)
		routerV1.POST("login", v1.Login)
		//分类模块路由接口
		routerV1.GET("category/list", v1.GetCategories)

		//文章模块路由接口
		routerV1.GET("article/info/:id", v1.GetArticle)
		routerV1.GET("article/list", v1.GetArticles)
		routerV1.GET("article/listByCategory/:id", v1.GetArticlesByCategoryId)
	}

	r.Run((utils.HttpPort))
}
