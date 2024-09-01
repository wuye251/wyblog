package db

import (
	"wyblog/internal/model"
	"wyblog/utils/errmsg"

	"gorm.io/gorm"
)

func GetByCategoryName(name string) model.Category {
	var category model.Category
	db.Select("id").Where("name", name).First(&category)
	return category
}

func GetCategories(pageSize, pageNum int) ([]model.Category, int64) {
	var category []model.Category
	var total int64
	err := db.Limit(pageSize).Offset((pageNum - 1) * pageSize).Order("sort desc").Find(&category).Error
	db.Model(&category).Count(&total)
	if err != nil && err != gorm.ErrRecordNotFound {
		return nil, total
	}
	return category, total
}

func GetById(id int) (*model.Category, int) {
	var category model.Category
	err := db.Where("id = ?", id).Find(&category).Error
	if err != nil && err != gorm.ErrRecordNotFound {
		return nil, errmsg.ERROR_ARTICLE_NOT_EXIST
	}
	return &category, errmsg.SUCCESS
}

func InsertCategory(data *model.Category) (code int) {
	err := db.Create(&data).Error
	if err != nil {
		return errmsg.ERROR
	}
	return errmsg.SUCCESS
}

func DeleteCategory(id int) (code int) {
	err := db.Delete(&model.Category{}, id).Error
	if err != nil {
		return errmsg.ERROR
	}

	return errmsg.SUCCESS
}

func UpdateCategory(id int, data *model.Category) (code int) {
	var info = make(map[string]interface{})
	info["name"] = data.Name
	info["sort"] = data.Sort

	err := db.Model(&model.Category{}).Where("id = ?", id).Updates(info).Error
	if err != nil {
		return errmsg.ERROR
	}
	return errmsg.SUCCESS
}
