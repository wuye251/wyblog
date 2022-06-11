package middleware

import (
	"net/http"
	"strings"
	"time"
	"wyblog/utils"
	"wyblog/utils/errmsg"

	"github.com/dgrijalva/jwt-go"
	"github.com/gin-gonic/gin"
)

var JwtKey = []byte(utils.JwtKey)

type MyClaims struct {
	Username string `json:"username"`
	jwt.StandardClaims
}

//生成token
func SetToken(username string) (string, int) {
	expireTime := time.Now().Add(10 * time.Hour)
	SetClaims := MyClaims{
		username,
		jwt.StandardClaims{
			ExpiresAt: expireTime.Unix(),
			Issuer:    "wyblog",
		},
	}

	reqClaim := jwt.NewWithClaims(jwt.SigningMethodHS256, SetClaims)
	token, err := reqClaim.SignedString(JwtKey)
	if err != nil {
		return "", errmsg.ERROR
	}

	return token, errmsg.SUCCESS
}

//验证token
func CheckToken(token string) (*MyClaims, int) {
	settoken, _ := jwt.ParseWithClaims(token, &MyClaims{}, func(t *jwt.Token) (interface{}, error) {
		return JwtKey, nil
	})
	if key, _ := settoken.Claims.(*MyClaims); settoken.Valid {
		return key, errmsg.SUCCESS
	} else {
		return nil, errmsg.ERROR
	}
}

//jwt中间件
func JwtToken() gin.HandlerFunc {
	return func(c *gin.Context) {
		tokenHeader := c.Request.Header.Get("Authorization") //是否有带token过来
		code := errmsg.SUCCESS
		if tokenHeader == "" {
			code = errmsg.ERROR_TOKEN_NOT_EXIST
			c.JSON(http.StatusOK, gin.H{
				"code":    code,
				"message": errmsg.GetErrMsg(code),
			})
			c.Abort()
			return
		}
		checkToken := strings.SplitN(tokenHeader, " ", 2) //截取token
		if len(checkToken) != 2 && checkToken[0] != "Bearer" {
			code = errmsg.ERROR_TOKEN_TYPE_WRONG
			c.JSON(http.StatusOK, gin.H{
				"code":    code,
				"message": errmsg.GetErrMsg(code),
			})
			c.Abort()
			return
		}

		key, retCode := CheckToken(checkToken[1]) //验证token
		if retCode == errmsg.ERROR {
			code = errmsg.ERROR_TOKEN_WRONG
			c.JSON(http.StatusOK, gin.H{
				"code":    code,
				"message": errmsg.GetErrMsg(code),
			})
			c.Abort()
			return
		}
		if time.Now().Unix() > key.ExpiresAt { //已过期
			code = errmsg.ERROR_TOKEN_RUNTIME
			c.JSON(http.StatusOK, gin.H{
				"code":    code,
				"message": errmsg.GetErrMsg(code),
			})
			c.Abort()
			return
		}
		c.JSON(http.StatusOK, gin.H{
			"code":    code,
			"message": errmsg.GetErrMsg(code),
		})
		c.Set("username", key.Username)
		c.Next()
	}
}
