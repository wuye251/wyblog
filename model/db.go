package model

import (
	"fmt"
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
	db.AutoMigrate(&User{}, &Article{}, &Category{})
	
	// db.Migrator().CreateIndex(&Article{}, "Status")
	// db.Migrator().CreateIndex(&Article{}, "idx_status")
	// // SetMaxIdleConns 设置空闲连接池中连接的最大数量
	// db.SetMaxIdleConns(10)

	// // SetMaxOpenConns 设置打开数据库连接的最大数量。
	// db.SetMaxOpenConns(100)

	// // SetConnMaxLifetime 设置了连接可复用的最大时间。
	// db.SetConnMaxLifetime(10 * time.Second)
}
