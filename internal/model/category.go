package model

type Category struct {
	Common
	Name string `gorm:"type:varchar(20);not null"  json:"name"`
	Sort string `json:"sort"`
	Pid  int    `gorm:"column:pid;type:int(11);not null;default:0" json:"pid"`
}

type CategoryWithSub struct {
	Category
	SubCategories []Category `json:"sub_categories"`
}
