package front

import (
	"fmt"
	"net/http"
	"strconv"
	"wyblog/model"
	"wyblog/utils/errmsg"

	"github.com/gin-gonic/gin"
)

//查询分类列表
func GetCategories(c *gin.Context) {
	pageSize, _ := strconv.Atoi(c.Query("pageSize"))
	pageNum, _ := strconv.Atoi(c.Query("pageNum"))

	fmt.Println("pageSize----", pageSize, " ----- pageNum:", pageNum)
	code := errmsg.SUCCESS
	list, total := model.GetCategories(pageSize, pageNum)
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
