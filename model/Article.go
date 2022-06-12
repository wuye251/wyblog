package model

import (
	"wyblog/utils/errmsg"

	"gorm.io/gorm"
)

type Article struct {
	Category Category `gorm:"foreignkey:CategoryId"`
	gorm.Model
	Title      string `gorm:"type:varchar(1000);not null;comment:标题" json:"title"`
	Desc       string `gorm:"type:varchar(200);comment:文章摘要描述" json:"desc"`
	Content    string `gorm:"type:longtext;not null;comment:文章内容" json:"content"`
	CategoryId int    `gorm:"type:int;not null;comment:文章类型id" json:"categoryId"`
	Img        string `gorm:"type:varchar(100);comment:文章插图" json:"img"`
}

// type Article struct {
// 	gorm.Model
// 	Category   Category
// 	Title      string `gorm:"type:varchar(1000);not null;comment:标题" json:"title"`
// 	Desc       string `gorm:"type:varchar(200);comment:文章摘要描述" json:"desc"`
// 	Content    string `gorm:"type:longtext;not null;comment:文章内容" json:"content"`
// 	Img        string `gorm:"type:varchar(100);comment:文章插图" json:"img"`
// }

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

func GetArticles(pageSize, pageNum int) ([]Article, int, int64) {
	var articleList []Article
	var total int64
	err := db.Preload("Category").Limit(pageSize).Offset((pageNum - 1) * pageSize).Find(&articleList).Error
	db.Model(&articleList).Count(&total)
	if err != nil && err != gorm.ErrRecordNotFound {
		return nil, errmsg.ERROR, total
	}

	return articleList, errmsg.SUCCESS, total
}

func GetArticleById(id int) (*Article, int) {
	var article Article
	err := db.Preload("Category").Where("id = ?", id).First(&article).Error
	if err != nil {
		return nil, errmsg.ERROR_ARTICLE_NOT_EXIST
	}

	return &article, errmsg.SUCCESS
}

func GetArticlesByCategoryId(categoryId int, pageSize, pageNum int) ([]Article, int, int) {
	var articleList []Article
	var total int64
	err := db.Preload("Category").Limit(pageSize).Offset((pageNum-1)*pageSize).Where("category_id = ?", categoryId).Find(&articleList).Error
	db.Model(&articleList).Where("category_id = ?", categoryId).Count(&total)
	if err != nil {
		return nil, errmsg.ERROR_CATEGORY_NOT_EXIST, int(total)
	}

	return articleList, errmsg.SUCCESS, int(total)
}
