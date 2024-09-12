package db

import (
	"wyblog/internal/model"
	"wyblog/utils/errmsg"

	"gorm.io/gorm"
)

// 新增用户
func InsertArticle(data *model.Article) (code int) {
	err := db.Create(&data).Error
	if err != nil {
		return errmsg.ERROR
	}

	return errmsg.SUCCESS
}

// 删除文章
func DeleteArticle(id int) (code int) {

	if id <= 0 {
		return errmsg.SUCCESS
	}

	err := db.Delete(&model.Article{}, id).Error
	if err != nil {
		return errmsg.ERROR
	}

	return errmsg.SUCCESS
}

// 更新文章信息
func UpdateArticleById(id int, articleInfo *model.Article) (code int) {
	var article model.Article
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

func GetArticles(pageSize, pageNum int, status int) ([]model.Article, int, int64) {
	var articleList []model.Article
	var total int64
	var err error

	if status == 0 { //查全部
		err = db.Preload("Category").Limit(pageSize).Offset((pageNum - 1) * pageSize).Order("updated_at desc").Find(&articleList).Error
		db.Model(&articleList).Count(&total)
	} else { //按照状态查
		err = db.Preload("Category").Where("status = ?", status).Order("updated_at desc").Limit(pageSize).Offset((pageNum - 1) * pageSize).Find(&articleList).Error
		db.Model(&articleList).Where("status = ?", status).Count(&total)
	}

	if err != nil && err != gorm.ErrRecordNotFound {
		return nil, errmsg.ERROR, total
	}

	return articleList, errmsg.SUCCESS, total
}

func GetArticleByIdAndStatus(id, status int) (*model.Article, int) {
	var article model.Article
	err := db.Preload("Category").Where("id = ?", id).Where("status = ?", status).First(&article).Error
	if err != nil {
		return nil, errmsg.ERROR_ARTICLE_NOT_EXIST
	}

	return &article, errmsg.SUCCESS
}

func GetArticleById(id int) (*model.Article, int) {
	var article model.Article
	err := db.Preload("Category").Where("id = ?", id).First(&article).Error
	if err != nil {
		return nil, errmsg.ERROR_ARTICLE_NOT_EXIST
	}

	return &article, errmsg.SUCCESS
}

func GetArticlesByCategoryId(categoryId int, pageSize, pageNum int, status int, withChild bool) ([]model.Article, int, int) {
	var articleList []model.Article
	var total int64
	var err error

	dbSession := db.Model(&model.Article{})
	if status != 0 {
		dbSession = dbSession.Where("status = ?", status)
	}
	if withChild {
		var categories []model.Category
		err = db.Model(&model.Category{}).Where("pid = ?", categoryId).Find(&categories).Error
		if err != nil {
			return nil, errmsg.ERROR_CATEGORY_NOT_EXIST, int(total)
		}
		categoriesId := make([]int, len(categories))
		for i, category := range categories {
			categoriesId[i] = category.ID
		}
		dbSession = dbSession.Where("category_id IN (?)", categoriesId)
	}
	dbSession = dbSession.Order("updated_at desc")
	err = dbSession.Count(&total).Error
	if err != nil {
		return nil, errmsg.ERROR_CATEGORY_NOT_EXIST, int(total)
	}

	err = dbSession.Limit(pageSize).Offset((pageNum - 1) * pageSize).Find(&articleList).Error
	if err != nil {
		return nil, errmsg.ERROR_CATEGORY_NOT_EXIST, int(total)
	}

	return articleList, errmsg.SUCCESS, int(total)
}
