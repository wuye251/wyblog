package db

import (
	"wyblog/internal/model"
	"wyblog/utils/errmsg"

	"gorm.io/gorm"
)

// 新增用户
func InsertUser(data *model.User) (code int) {
	// data.Password = ScryptPwd(data.Password)
	err := db.Create(&data).Error
	if err != nil {
		return errmsg.ERROR
	}

	return errmsg.SUCCESS
}

// 查询用户是否存在
func GetByUserName(username string) (code int) {
	var users model.User
	db.Select("id").Where("username = ?", username).First(&users)
	if users.ID > 0 {
		return errmsg.ERROR_USERNAME_USED
	}

	return errmsg.SUCCESS
}

// 查询用户列表
func GetUsers(pageSize, pageNum int, username string) ([]model.User, int64) {
	var users []model.User
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

// 删除用户
func DeleteById(id int) (code int) {

	if id <= 0 {
		return errmsg.SUCCESS
	}

	err := db.Delete(&model.User{}, id).Error
	if err != nil {
		return errmsg.ERROR
	}

	return errmsg.SUCCESS
}

// 更新用户信息
func UpdateById(id int, userInfo *model.User) (code int) {
	var user model.User
	var data = make(map[string]interface{})
	data["username"] = userInfo.Username
	data["role"] = userInfo.Role

	err := db.Model(&user).Where("id = ?", id).Updates(data).Error
	if err != nil {
		return errmsg.ERROR
	}
	return errmsg.SUCCESS
}

// 登录验证
func CheckLogin(username string, password string) int {
	var user model.User
	code := errmsg.SUCCESS
	db.Where("username = ?", username).First(&user)
	if user.ID == 0 || model.ScryptPwd(password) != user.Password {
		code = errmsg.ERROR_PASSWORD_WRONG
		return code
	}

	if user.Role != 1 {
		return errmsg.ERROR_USER_NO_RIGHT
	}

	return code
}

func GetUserById(id int) (*model.User, int) {
	if id <= 0 {
		return nil, errmsg.ERROR
	}

	var user model.User
	code := errmsg.SUCCESS
	db.Where("id = ?", id).First(&user)

	return &user, code
}
