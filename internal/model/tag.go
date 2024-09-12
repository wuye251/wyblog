package model

type Tag struct {
	Common
	Name string `gorm:"type:varchar(20);not null"  json:"name"`
	Sort string `json:"sort"`
}
