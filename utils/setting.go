package utils

import (
	"fmt"

	"gopkg.in/ini.v1"
)

var (
	AppMode    string
	HttpPort   string
	Db         string
	DbHost     string
	DbPort     string
	DbUser     string
	DbPassWord string
	DbName     string
)

func init() {
	file, err := ini.Load("config/config.ini")
	if err != nil {
		fmt.Println("配置文件读取错误，请检查文件路径：", err)
	}
	LoadServer(file)
	LoadData(file)
}

func LoadServer(file *ini.File) {
	AppMode = file.Section("server").Key("AppMode").MustString("debug")
	HttpPort = file.Section("server").Key("HttpPort").MustString("http")
}

func LoadData(file *ini.File) {
	AppMode = file.Section("server").Key("AppMode").MustString("development")
	HttpPort = file.Section("server").Key("HttpPort").MustString(":3000")
	Db = file.Section("server").Key("Db").MustString("debug")
	DbHost = file.Section("server").Key("DbHost").MustString("http")
	DbPort = file.Section("server").Key("DbPort").MustString("3306")
	DbUser = file.Section("server").Key("DbUser").MustString("root")
	DbPassWord = file.Section("server").Key("DbPassWord").MustString("")
	DbName = file.Section("server").Key("DbName").MustString("wyblog")
}
