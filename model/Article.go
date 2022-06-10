package model

import (
	"wyblog/utils/errmsg"

	"gorm.io/gorm"
)

// type Article struct {
// 	gorm.Model
// 	Title    string `gorm:"type:varchar(1000);not null;comment:标题" json:"title"`
// 	Desc     string `gorm:"type:varchar(200);comment:文章摘要描述" json:"desc"`
// 	Content  string `gorm:"type:longtext;not null;comment:文章内容" json:"content"`
// 	CategoryId      int    `gorm:"type:int;not null;comment:文章类型id" json:"categoryId"`
// 	Img      string `gorm:"type:varchar(100);comment:文章插图" json:"img"`
// }

type Article struct {
	gorm.Model
	Category   Category `gorm:"foreignKey:ID;references:CategoryId;"`
	Title      string   `gorm:"type:varchar(1000);not null;comment:标题" json:"title"`
	CategoryId int      `gorm:"type:int;not null;comment:文章类型id" json:"categoryId"`
	Desc       string   `gorm:"type:varchar(200);comment:文章摘要描述" json:"desc"`
	Content    string   `gorm:"type:longtext;not null;comment:文章内容" json:"content"`
	Img        string   `gorm:"type:varchar(100);comment:文章插图" json:"img"`
}

//新增用户
func InsertArticle(data *Article) (code int) {
	err := db.Create(&data).Error
	if err != nil {
		return errmsg.ERROR
	}

	return errmsg.SUCCESS
}

//删除文章
func DeleteArticle(id int) (code int) {

	if id <= 0 {
		return errmsg.SUCCESS
	}

	err := db.Delete(&Article{}, id).Error
	if err != nil {
		return errmsg.ERROR
	}

	return errmsg.SUCCESS
}

//更新文章信息
func UpdateArticleById(id int, articleInfo *Article) (code int) {
	var article Article
	var data = make(map[string]interface{})
	data["title"] = articleInfo.Title
	data["category_id"] = articleInfo.CategoryId
	data["desc"] = articleInfo.Desc
	data["content"] = articleInfo.Content
	data["img"] = articleInfo.Img

	err := db.Model(&article).Where("id = ?", id).Updates(data).Error
	if err != nil {
		return errmsg.ERROR
	}
	return errmsg.SUCCESS
}
