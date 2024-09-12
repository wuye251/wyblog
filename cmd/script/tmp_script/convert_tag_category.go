package tmp_script

import (
	"log"
	"wyblog/internal/dao/db"
	"wyblog/internal/model"

	"github.com/urfave/cli/v2"
)

func convertTagCategory() error {
	db.InitDb()
	dbSession := db.GetDb()

	tx := dbSession.Begin()
	if tx.Error != nil {
		return tx.Error
	}
	defer func() {
		if r := recover(); r != nil {
			tx.Rollback()
		}
	}()

	// 文章category转换为tag
	categories := []*model.Category{}
	err := dbSession.Raw("Select * from categories where deleted_at is null order by id asc").Find(&categories).Error
	if err != nil {
		log.Fatalf("查询category失败:%v", err)
		return err
	}

	articles := []*model.Article{}
	err = dbSession.Raw("Select * from articles where deleted_at is null order by id asc").Find(&articles).Error
	if err != nil {
		log.Fatalf("查询article失败:%v", err)
		return err
	}

	insertTags := []*model.Tag{}
	tagCategoryMap := map[int]*model.Tag{}
	for _, category := range categories {
		tag := &model.Tag{
			Name: category.Name,
			Sort: category.Sort,
		}
		insertTags = append(insertTags, tag)
		tagCategoryMap[category.ID] = tag
	}
	err = dbSession.Create(&insertTags).Error
	if err != nil {
		log.Fatalf("插入tag失败:%v", err)
		return err
	}

	insertTagArticleMap := []*model.ArticleTag{}
	for _, article := range articles {
		tagInfo := tagCategoryMap[article.CategoryId]
		tagArticleMap := model.ArticleTag{
			ArticleId: int(article.ID),
			TagId:     int(tagInfo.ID),
		}
		insertTagArticleMap = append(insertTagArticleMap, &tagArticleMap)
	}
	err = dbSession.Create(&insertTagArticleMap).Error
	if err != nil {
		log.Fatalf("插入article_tag失败:%v", err)
		return err
	}
	return nil

}

// 命令选项
func convertTagCategoryFlags() []cli.Flag {
	return []cli.Flag{}
}
