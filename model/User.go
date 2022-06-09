package model

import "gorm.io/gorm"

type User struct {
	gorm.Model
	Username string `gorm:"type:varchar(20);not null;comment:用户名称" json:"username"`
	Password string `gorm:"type:varchar(20);not null;comment:用户密码" json:"password" `
	Role     int    `gorm:"type:int;comment:身份" json:"role"`
}
