const { defineConfig } = require('@vue/cli-service')
const CompressionWebpackPlugin = require('compression-webpack-plugin')
const isProduction = process.env.NODE_ENV === 'production'


module.exports = defineConfig({
  transpileDependencies: true,
  lintOnSave: false,
  publicPath: '/admin/',
  outputDir:'dist',
  assetsDir:'static',
  configureWebpack: config => {
    if (isProduction) {
        // 开启gzp压缩
        config.plugins.push(
            new CompressionWebpackPlugin({
                // 正在匹配需要压缩的文件后缀
                test: /\.(js|css|svg|woff|ttf|json|html)$/,
                // 大于10kb的会压缩
                threshold: 10240
                // 其余配置查看compression-webpack-plugin
            })
        )
    }
  },
})
