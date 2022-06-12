package v1

import (
	"fmt"
	"net/http"
	"strconv"
	"wyblog/model"
	"wyblog/utils/errmsg"
	"wyblog/utils/validate"

	"github.com/gin-gonic/gin"
)

//添加用户
func AddUser(c *gin.Context) {
	var code int
	var msg string
	var param model.User
	_ = c.ShouldBindJSON(&param)
	msg, code = validate.Validate(&param)
	if code != errmsg.SUCCESS {
		c.JSON(http.StatusOK, gin.H{
			"code":    code,
			"message": msg,
			"data":    "",
		})
		return
	}

	code = model.GetByUserName(param.Username)
	if code == errmsg.SUCCESS {
		model.InsertUser(&param)
	}

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    param,
	})
}

//删除用户
func DeleteUser(c *gin.Context) {

	userId, _ := strconv.Atoi(c.Param("id"))
	code := model.DeleteById(userId)
	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    fmt.Sprintf("userId is %v delete success", userId),
	})
}

//更新用户
func UpdateUser(c *gin.Context) {
	var data model.User
	id, _ := strconv.Atoi(c.Param("id"))
	_ = c.ShouldBindJSON(&data)

	code := model.GetByUserName(data.Username)
	fmt.Println("getByUserName code:", code)
	if code == errmsg.SUCCESS {
		code = model.UpdateById(id, &data)
	}

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    data,
	})
}

//查询用户列表
func GetUsers(c *gin.Context) {
	pageSize, _ := strconv.Atoi(c.Query("pageSize"))
	pageNum, _ := strconv.Atoi(c.Query("pageNum"))

	fmt.Println("pageSize----", pageSize, " ----- pageNum:", pageNum)
	code := errmsg.SUCCESS
	list, total := model.GetUsers(pageSize, pageNum)
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
