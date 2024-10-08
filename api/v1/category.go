package v1

import (
	"fmt"
	"net/http"
	"strconv"
	"wyblog/internal/dao/db"
	"wyblog/internal/model"
	"wyblog/utils/errmsg"

	"github.com/gin-gonic/gin"
)

// 添加分类
func AddCategory(c *gin.Context) {
	var data model.Category
	_ = c.ShouldBindJSON(&data)

	res := db.GetByCategoryName(data.Name)
	var code int
	if res.ID != 0 {
		code = errmsg.ERROR_CATEGORY_USED
	} else {
		code = db.InsertCategory(&data)
	}

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    data,
	})
}

// 删除分类
func DeleteCategory(c *gin.Context) {

	id, _ := strconv.Atoi(c.Param("id"))
	code := db.DeleteCategory(id)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    id,
	})
}

// 更新分类
func UpdateCategory(c *gin.Context) {
	id, _ := strconv.Atoi(c.Param("id"))
	var category model.Category
	_ = c.ShouldBindJSON(&category)
	fmt.Println(category)
	res := db.GetByCategoryName(category.Name)
	var code int
	if res.ID != 0 && res.ID != id {
		code = errmsg.ERROR_CATEGORY_USED
	}
	code = db.UpdateCategory(id, &category)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    id,
	})

}

// 查询分类列表
func GetCategories(c *gin.Context) {
	pageSize, _ := strconv.Atoi(c.Query("pageSize"))
	pageNum, _ := strconv.Atoi(c.Query("pageNum"))

	code := errmsg.SUCCESS
	list, total := db.GetCategories(pageSize, pageNum)
	if list == nil {
		code = errmsg.ERROR
	}

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    list,
		"total":   total,
	})
}

// 查询单个category信息
func GetCategoryById(c *gin.Context) {
	id, _ := strconv.Atoi(c.Param("id"))
	data, code := db.GetById(id)

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    data,
	})
}
