package model

import (
	"wyblog/utils/errmsg"

	"gorm.io/gorm"
)

type Category struct {
	gorm.Model
	Name string `gorm:"type:varchar(20);not null"  json:"name"`
}

func GetByCategoryName(name string) (code int) {
	var category Category
	db.Select("id").Where("name", name).First(&category)
	if category.ID > 0 {
		return errmsg.ERROR_CATEGORY_USED
	}

	return errmsg.SUCCESS
}

func InsertCategory(data *Category) (code int) {
	err := db.Create(&data).Error
	if err != nil {
		return errmsg.ERROR
	}
	return errmsg.SUCCESS
}

func DeleteCategory(id int) (code int) {
	err := db.Delete(&Category{}, id).Error
	if err != nil {
		return errmsg.ERROR
	}

	return errmsg.SUCCESS
}

func UpdateCategory(id int, data *Category) (code int) {
	var info = make(map[string]interface{})
	info["name"] = data.Name

	err := db.Model(&Category{}).Where("id = ?", id).Updates(info).Error
	if err != nil {
		return errmsg.ERROR
	}
	return errmsg.SUCCESS
}
func GetCategories(pageSize, pageNum int) []Category {
	var category []Category
	err := db.Limit(pageSize).Offset((pageNum - 1) * pageSize).Find(&category).Error
	if err != nil && err != gorm.ErrRecordNotFound {
		return nil
	}
	return category
}
