package v1

import (
	"net/http"
	"wyblog/middleware"
	"wyblog/model"
	"wyblog/utils/errmsg"

	"github.com/gin-gonic/gin"
)

func Login(c *gin.Context) {
	var data model.User
	c.ShouldBindJSON(&data)

	code := model.CheckLogin(data.Username, data.Password)
	var token string
	if code == errmsg.SUCCESS {
		token, code = middleware.SetToken(data.Username)
	}

	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    token,
	})
}
