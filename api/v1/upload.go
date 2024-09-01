package v1

import (
	"fmt"
	"net/http"
	"wyblog/internal/model"
	"wyblog/utils/errmsg"

	"github.com/gin-gonic/gin"
)

func Upload(c *gin.Context) {
	file, fileHeader, _ := c.Request.FormFile("file")
	fileSize := fileHeader.Size
	fmt.Println("upload start ========")
	url, code := model.UploadFile(file, fileSize)
	fmt.Println(url)
	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    url,
	})
}
