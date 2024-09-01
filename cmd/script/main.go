package main

import (
	"log"
	"os"
	"wyblog/cmd/script/tmp_script"

	"github.com/urfave/cli/v2"
)

func main() {
	app := &cli.App{
		Name:                 "cmd",
		Usage:                "blog cmd脚本",
		EnableBashCompletion: true,
		Flags: []cli.Flag{
			&cli.BoolFlag{
				Name:    "config",
				Aliases: []string{"c"},
				Value:   false,
				Usage:   "use local config to override consul config",
			},
		},
		Before: func(ctx *cli.Context) error {
			return nil
		},
		After: func(ctx *cli.Context) error {
			return nil
		},
		Commands: []*cli.Command{
			tmp_script.ScriptCommand,
		},
	}

	err := app.Run(os.Args)
	if err != nil {
		log.Fatal(err)
	}
}
