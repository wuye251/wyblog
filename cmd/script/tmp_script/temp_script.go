package tmp_script

import (
	"github.com/urfave/cli/v2"
)

var ScriptCommand = &cli.Command{
	Name:  "tmp",
	Usage: "临时脚本",
	Before: func(ctx *cli.Context) error {
		return nil
	},
	Subcommands: []*cli.Command{
		{
			Name:    "convert-tag-category",
			Usage:   "加入tag和category",
			Aliases: []string{"ctc"},
			Flags:   convertTagCategoryFlags(),
			Action: func(ctx *cli.Context) error {
				return convertTagCategory()
			},
		},
	},
}
