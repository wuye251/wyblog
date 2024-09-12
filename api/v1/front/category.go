package front

import (
	"fmt"
	"net/http"
	"strconv"
	"wyblog/internal/dao/db"
	"wyblog/internal/model"
	"wyblog/utils/errmsg"

	"github.com/gin-gonic/gin"
)

// 查询分类列表
func GetCategories(c *gin.Context) {
	pageSize, _ := strconv.Atoi(c.Query("pageSize"))
	pageNum, _ := strconv.Atoi(c.Query("pageNum"))

	fmt.Println("pageSize----", pageSize, " ----- pageNum:", pageNum)
	code := errmsg.SUCCESS
	list, total := db.GetCategories(pageSize, pageNum)
	if list == nil {
		code = errmsg.ERROR
	}
	rootCategories := make([]model.Category, 0, len(list))
	subCategoriesMap := make(map[int][]model.Category)
	for _, item := range list {
		if item.Pid == 0 {
			rootCategories = append(rootCategories, item)
		} else {
			if _, ok := subCategoriesMap[item.Pid]; !ok {
				subCategoriesMap[item.Pid] = make([]model.Category, 0, 1)
			}
			subCategoriesMap[item.Pid] = append(subCategoriesMap[item.Pid], item)
		}
	}

	rtn := make([]model.CategoryWithSub, 0, len(list))
	for _, item := range rootCategories {
		subCategories := make([]model.Category, 0, 1)
		if _, ok := subCategoriesMap[item.ID]; ok {
			subCategories = subCategoriesMap[item.ID]
		}
		rtn = append(rtn, model.CategoryWithSub{
			Category:      item,
			SubCategories: subCategories,
		})
	}
	c.JSON(http.StatusOK, gin.H{
		"code":    code,
		"message": errmsg.GetErrMsg(code),
		"data":    rtn,
		"total":   total,
	})
}
