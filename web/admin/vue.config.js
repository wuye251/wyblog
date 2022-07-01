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
  publicPath: '/admin/',
  outputDir:'dist',
  assetsDir:'static',
  // 配置webpack
  configureWebpack: config => {
    if (isProduction) {
      config.plugins.push(new CompressionWebpackPlugin({
        algorithm: 'gzip',
        test: /\.js$|\.html$|\.json$|\.css/,
        threshold: 10240,
        minRatio: 0.8
      }));

      // 开启分离js
      // config.optimization = {
      //   runtimeChunk: 'single',
      //   splitChunks: {
      //     chunks: 'all',
      //     maxInitialRequests: Infinity,
      //     minSize: 20000,
      //     cacheGroups: {
      //       vendor: {
      //           test: /[\\/]node_modules[\\/]/,
      //           name(module) {
      //               const packageName = module.context.match(/[\\/]node_modules[\\/](.*?)([\\/]|$)/)[1];
      //               return `npm.${packageName.replace('@', '')}`;
      //           },
      //       }
      //     },
      //   }
      // };
    }
  }
})
