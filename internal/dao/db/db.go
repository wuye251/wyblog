package db

import (
	"fmt"
	"time"
	"wyblog/internal/model"
	"wyblog/utils"

	"gorm.io/driver/mysql"
	"gorm.io/gorm"
)

var db *gorm.DB

func InitDb() {
	dsn := fmt.Sprintf("%s:%s@tcp(%s:%s)/%s?charset=utf8mb4&parseTime=True&loc=Local", utils.DbUser, utils.DbPassWord, utils.DbHost, utils.DbPort, utils.DbName)
	var err error
	db, err = gorm.Open(mysql.Open(dsn), &gorm.Config{})
	if err != nil {
		fmt.Println("数据库连接失败 dsn：", dsn, "\n err:", err)
	}
	db.AutoMigrate(&model.User{}, &model.Article{}, &model.Category{}, &model.Tag{}, &model.ArticleTag{})

	sqlDB, _ := db.DB()
	sqlDB.SetConnMaxLifetime(time.Hour * 4)
}
