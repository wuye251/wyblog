package model

import (
	"encoding/base64"
	"log"
	"wyblog/utils/errmsg"

	"golang.org/x/crypto/scrypt"
	"gorm.io/gorm"
)

type User struct {
	gorm.Model
	Username string `gorm:"type:varchar(20);not null;comment:用户名称" json:"username"`
	Password string `gorm:"type:varchar(20);not null;comment:用户密码" json:"password" `
	Role     int    `gorm:"type:int;comment:身份" json:"role"`
}

//新增用户
func InsertUser(data *User) (code int) {
	// data.Password = ScryptPwd(data.Password)
	err := db.Create(&data).Error
	if err != nil {
		return errmsg.ERROR
	}

	return errmsg.SUCCESS
}

//查询用户是否存在
func GetByUserName(username string) (code int) {
	var users User
	db.Select("id").Where("username = ?", username).First(&users)
	if users.ID > 0 {
		return errmsg.ERROR_USERNAME_USED
	}

	return errmsg.SUCCESS
}

//查询用户列表
func GetUsers(pageSize, pageNum int) []User {
	var users []User
	err := db.Limit(pageSize).Offset((pageNum - 1) * pageSize).Find(&users).Error
	if err != nil && err != gorm.ErrRecordNotFound {
		return nil
	}
	return users
}

//密码加密
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

//保存前的前置钩子
func (u *User) BeforeSave(tx *gorm.DB) (err error) {
	u.Password = ScryptPwd(u.Password)
	return
}

//删除用户
func DeleteById(id int) (code int) {

	if id <= 0 {
		return errmsg.SUCCESS
	}

	err := db.Delete(&User{}, id).Error
	if err != nil {
		return errmsg.ERROR
	}

	return errmsg.SUCCESS
}

//更新用户信息
func UpdateById(id int, userInfo *User) (code int) {
	var user User
	var data = make(map[string]interface{})
	data["username"] = userInfo.Username
	data["role"] = userInfo.Role

	err := db.Model(&user).Where("id = ?", id).Updates(data).Error
	if err != nil {
		return errmsg.ERROR
	}
	return errmsg.SUCCESS
}
