package model

import "gorm.io/gorm"

type ArticleTag struct {
	gorm.Model
	ArticleId int    `gorm:"int;not null" json:"article_id"`
	TagId     int    `gorm:"int;not null" json:"tag_id"`
	Sort      string `json:"sort"`
}
