package model

import (
	"encoding/base64"
	"log"

	"golang.org/x/crypto/scrypt"
	"gorm.io/gorm"
)

type User struct {
	gorm.Model
	Username string `gorm:"type:varchar(20);not null;comment:用户名称" json:"username" validate:"required,min=4,max=12" label:"用户名"`
	Password string `gorm:"type:varchar(20);not null;comment:用户密码" json:"password" validate:"required,min=6,max=20" label:"密码"`
	Role     int    `gorm:"type:int;comment:身份1管理员 2用户" json:"role" validate:"required,gte=2" label:"身份"`
}

// 保存前的前置钩子
func (u *User) BeforeSave(tx *gorm.DB) (err error) {
	u.Password = ScryptPwd(u.Password)
	return
}

// 密码加密
func ScryptPwd(password string) string {
	const KeyLen = 10
	salt := make([]byte, 8)
	salt = []byte{12, 32, 4, 6, 66, 22, 222, 11}

	HashPwd, err := scrypt.Key([]byte(password), salt, 16384, 8, 1, KeyLen)
	if err != nil {
		log.Fatal(err)
	}
	fpwd := base64.StdEncoding.EncodeToString(HashPwd)

	return fpwd
}
