package model

import (
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
