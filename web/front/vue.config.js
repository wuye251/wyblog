const { defineConfig } = require('@vue/cli-service')
const CompressionWebpackPlugin = require('compression-webpack-plugin');
const isProduction = process.env.NODE_ENV === 'production';
const Timestamp = new Date().getTime();

module.exports = defineConfig({
  configureWebpack: {
    //每次打包后生成的js携带时间戳
    output: {
      filename: `[name].${Timestamp}.js`,
      chunkFilename: `[name].${Timestamp}.js`,
    },
  },
  transpileDependencies: true,
  lintOnSave: false,
  publicPath: './front',
  outputDir:'dist',
  assetsDir:'static',
  configureWebpack: config => {
    if (isProduction) {
      config.plugins.push(new CompressionWebpackPlugin({
        algorithm: 'gzip',
        test: /\.js$|\.html$|\.json$|\.css/,
        threshold: 10240,
        minRatio: 0.8
      }));
    }
  },

  // configureWebpack: {
  //   externals: {
  //     'vue': 'Vue',
  //     'ant-design-vue': 'antd',
  //   }
  // }
})
