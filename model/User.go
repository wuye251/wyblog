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
	Username string `gorm:"type:varchar(20);not null;comment:用户名称" json:"username" validate:"required,min=4,max=12" label:"用户名"`
	Password string `gorm:"type:varchar(20);not null;comment:用户密码" json:"password" validate:"required,min=6,max=20" label:"密码"`
	Role     int    `gorm:"type:int;comment:身份1管理员 2用户" json:"role" validate:"required,gte=2" label:"身份"`
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
func GetUsers(pageSize, pageNum int, username string) ([]User, int64) {
	var users []User
	var total int64

	var err error
	if username != "" {
		err = db.Where("username like ?", "%"+username+"%").Limit(pageSize).Offset((pageNum - 1) * pageSize).Find(&users).Error
		db.Model(&users).Where("username like ?", "%"+username+"%").Count(&total)
	} else {
		err = db.Limit(pageSize).Offset((pageNum - 1) * pageSize).Find(&users).Error
		db.Model(&users).Count(&total)
	}

	if err != nil && err != gorm.ErrRecordNotFound {
		return nil, total
	}
	return users, total
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

//登录验证
func CheckLogin(username string, password string) int {
	var user User
	code := errmsg.SUCCESS
	db.Where("username = ?", username).First(&user)
	if user.ID == 0 || ScryptPwd(password) != user.Password {
		code = errmsg.ERROR_PASSWORD_WRONG
		return code
	}

	if user.Role != 1 {
		return errmsg.ERROR_USER_NO_RIGHT
	}

	return code
}

func GetUserById(id int) (*User, int) {
	if id <= 0 {
		return nil, errmsg.ERROR
	}

	var user User
	code := errmsg.SUCCESS
	db.Where("id = ?", id).First(&user)

	return &user, code
}
