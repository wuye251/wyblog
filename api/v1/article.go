package v1

import (
	"net/http"
	"strconv"
	"wyblog/internal/dao/db"
	"wyblog/internal/model"
	"wyblog/utils/errmsg"

	"github.com/gin-gonic/gin"
)

// 添加文章
func AddArticle(c *gin.Context) {
	var data model.Article
	_ = c.ShouldBindJSON(&data)

	code := db.InsertArticle(&data)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    data,
	})
}

// 删除文章
func DeleteArticle(c *gin.Context) {

	id, _ := strconv.Atoi(c.Param("id"))
	code := db.DeleteArticle(id)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    id,
	})
}

// 更新文章
func UpdateArticle(c *gin.Context) {
	id, _ := strconv.Atoi(c.Param("id"))
	var article model.Article
	_ = c.ShouldBindJSON(&article)
	code := db.UpdateArticleById(id, &article)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    id,
	})

}

// todo 查询单个文章
func GetArticle(c *gin.Context) {
	id, _ := strconv.Atoi(c.Param("id"))
	data, code := db.GetArticleById(id)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    data,
	})
}

// todo 查询分类下文章列表
func GetArticlesByCategoryId(c *gin.Context) {
	categoryId, _ := strconv.Atoi(c.Param("id"))
	pageSize, _ := strconv.Atoi(c.Query("pageSize"))
	pageNum, _ := strconv.Atoi(c.Query("pageNum"))
	status, _ := strconv.Atoi(c.Query("status"))
	data, code, total := db.GetArticlesByCategoryId(categoryId, pageSize, pageNum, status, false)
	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    data,
		"total":   total,
	})
}

// 查询文章列表
func GetArticles(c *gin.Context) {
	pageSize, _ := strconv.Atoi(c.Query("pageSize"))
	pageNum, _ := strconv.Atoi(c.Query("pageNum"))
	status, _ := strconv.Atoi(c.Query("status"))
	list, code, total := db.GetArticles(pageSize, pageNum, status)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    list,
		"total":   total,
	})
}
