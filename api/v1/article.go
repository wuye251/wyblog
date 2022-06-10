package v1

import (
	"net/http"
	"strconv"
	"wyblog/model"
	"wyblog/utils/errmsg"

	"github.com/gin-gonic/gin"
)

//添加文章
func AddArticle(c *gin.Context) {
	var data model.Article
	_ = c.ShouldBindJSON(&data)

	code := model.InsertArticle(&data)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    data,
	})
}

//删除文章
func DeleteArticle(c *gin.Context) {

	id, _ := strconv.Atoi(c.Param("id"))
	code := model.DeleteArticle(id)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    id,
	})
}

//更新文章
func UpdateArticle(c *gin.Context) {
	id, _ := strconv.Atoi(c.Param("id"))
	var article model.Article
	_ = c.ShouldBindJSON(&article)
	code := model.UpdateArticleById(id, &article)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    id,
	})

}

//todo 查询单个文章

//todo 查询分类下文章列表
