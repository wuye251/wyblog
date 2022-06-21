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
	Status     int    `gorm:"type:int;not null;default:1;index:idx_status;comment:文章状态 1草稿 2发布 3已删除" json:"status"`
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
	data["status"] = articleInfo.Status

	err := db.Model(&article).Where("id = ?", id).Updates(data).Error
	if err != nil {
		return errmsg.ERROR
	}
	return errmsg.SUCCESS
}

func GetArticles(pageSize, pageNum int, status int) ([]Article, int, int64) {
	var articleList []Article
	var total int64
	var err error

	if status == 0 { //查全部
		err = db.Preload("Category").Limit(pageSize).Offset((pageNum - 1) * pageSize).Find(&articleList).Error
		db.Model(&articleList).Count(&total)
	} else { //按照状态查
		err = db.Preload("Category").Where("status = ?", status).Limit(pageSize).Offset((pageNum - 1) * pageSize).Find(&articleList).Error
		db.Model(&articleList).Where("status = ?", status).Count(&total)
	}

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

func GetArticlesByCategoryId(categoryId int, pageSize, pageNum int, status int) ([]Article, int, int) {
	var articleList []Article
	var total int64
	var err error

	if status == 0 {
		err = db.Preload("Category").Limit(pageSize).Offset((pageNum-1)*pageSize).Where("category_id = ?", categoryId).Find(&articleList).Error
		db.Model(&articleList).Where("category_id = ?", categoryId).Count(&total)
	} else {
		err = db.Preload("Category").Limit(pageSize).Offset((pageNum-1)*pageSize).Where("category_id = ?", categoryId).Where("status = ?", status).Find(&articleList).Error
		db.Model(&articleList).Where("category_id = ?", categoryId).Where("status = ?", status).Count(&total)
	}

	if err != nil {
		return nil, errmsg.ERROR_CATEGORY_NOT_EXIST, int(total)
	}

	return articleList, errmsg.SUCCESS, int(total)
}
