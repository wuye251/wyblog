module.exports = {
  presets: [
    '@vue/cli-plugin-babel/preset'
  ],
  plugins: [
    [
        'prismjs', {
          // languages: ['go','vue','javascript', 'java', 'css', 'markup', 'python'],
          languages:allLanguages,
          plugins: ["line-numbers"],
          theme: 'solarizedlight',
          css: true
        }
    ]
  ]
}
