package file

import (
	"os"
	"path/filepath"
)

// findGoModRoot 从当前目录向上递归查找 go.mod 所在的目录，推断项目根路径
func GetRootPath() string {
	cwd, err := os.Getwd()
	if err != nil {
		return ""
	}

	for {
		if _, err := os.Stat(filepath.Join(cwd, "go.mod")); err == nil {
			return cwd
		}

		parentDir := filepath.Dir(cwd)
		if parentDir == cwd {
			return ""
		}
		cwd = parentDir
	}
}
