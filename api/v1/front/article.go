package front

import (
	"net/http"
	"strconv"
	"wyblog/config/enum"
	"wyblog/internal/dao/db"
	"wyblog/utils/errmsg"

	"github.com/gin-gonic/gin"
)

// todo 查询单个文章
func GetArticle(c *gin.Context) {
	id, _ := strconv.Atoi(c.Param("id"))
	data, code := db.GetArticleByIdAndStatus(id, enum.ARTICLE_STATUS_PUBLISH)

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
	// status, _ := strconv.Atoi(c.Query("status"))
	data, code, total := db.GetArticlesByCategoryId(categoryId, pageSize, pageNum, enum.ARTICLE_STATUS_PUBLISH, true)
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
	// status, _ := strconv.Atoi(c.Query("status"))
	list, code, total := db.GetArticles(pageSize, pageNum, enum.ARTICLE_STATUS_PUBLISH)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    list,
		"total":   total,
	})
}
