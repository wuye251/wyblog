package v1

import (
	"fmt"
	"net/http"
	"strconv"
	"wyblog/model"
	"wyblog/utils/errmsg"

	"github.com/gin-gonic/gin"
)

//添加分类
func AddCategory(c *gin.Context) {
	var data model.Category
	_ = c.ShouldBindJSON(&data)

	code := model.GetByCategoryName(data.Name)
	if code == errmsg.SUCCESS {
		code = model.InsertCategory(&data)
	}

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    data,
	})
}

//删除分类
func DeleteCategory(c *gin.Context) {

	id, _ := strconv.Atoi(c.Param("id"))
	code := model.DeleteCategory(id)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    id,
	})
}

//更新分类
func UpdateCategory(c *gin.Context) {
	id, _ := strconv.Atoi(c.Param("id"))
	var category model.Category
	_ = c.ShouldBindJSON(&category)
	code := model.GetByCategoryName(category.Name)
	if code == errmsg.SUCCESS {
		code = model.UpdateCategory(id, &category)
	}

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    id,
	})

}

//查询单个分类下的文章
func GetArticlesByCategoryId(c *gin.Context) {

}

//查询分类列表
func GetCategories(c *gin.Context) {
	pageSize, _ := strconv.Atoi(c.Query("pageSize"))
	pageNum, _ := strconv.Atoi(c.Query("pageNum"))

	fmt.Println("pageSize----", pageSize, " ----- pageNum:", pageNum)
	code := errmsg.SUCCESS
	list := model.GetCategories(pageSize, pageNum)
	if list == nil {
		code = errmsg.ERROR
	}

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    list,
	})
}
