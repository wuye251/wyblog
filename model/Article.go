package model

import "gorm.io/gorm"

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
	Category Category `gorm:"foreignKey:ID;references:CategoryId;"`
	Title    string `gorm:"type:varchar(1000);not null;comment:标题" json:"title"`
	CategoryId      int    `gorm:"type:int;not null;comment:文章类型id" json:"categoryId"`
	Desc     string `gorm:"type:varchar(200);comment:文章摘要描述" json:"desc"`
	Content  string `gorm:"type:longtext;not null;comment:文章内容" json:"content"`
	Img      string `gorm:"type:varchar(100);comment:文章插图" json:"img"`
}
