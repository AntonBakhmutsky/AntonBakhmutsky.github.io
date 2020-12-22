const fs = require('fs')

if (process.env.NODE_ENV !== 'production') {
  module.exports = {
    devServer: {
      https: {
        key: process.env.DEV_HTTPS_KEY
          ? fs.readFileSync(process.env.DEV_HTTPS_KEY)
          : false,
        cert: process.env.DEV_HTTPS_CRT
          ? fs.readFileSync(process.env.DEV_HTTPS_CRT)
          : false
      },
      host: process.env.DEV_SERVER_HOST,
      port: process.env.DEV_SERVER_PORT,
      disableHostCheck: true
    }
  }
}


module.exports.pwa = {
  workboxPluginMode: 'GenerateSW',
  name: 'Gorilla Energy',
  themeColor: '#ffffff',
  msTileColor: '#00a300',
  appleMobileWebAppCapable: 'yes',
  appleMobileWebAppStatusBarStyle: '#5bbad5',
  manifestPath: 'manifest.json',
  manifestOptions: {
    name: 'Gorilla Energy',
    short_name: 'Gorilla Energy',
    icons: [
      {
        src: './img/icons/android-chrome-72x72.png',
        sizes: '72x72',
        type: 'image/png'
      }
    ],
    start_url: '.',
    display: 'standalone',
    orientation: 'portrait-primary',
    theme_color: '#ffffff',
    background_color: '#ffffff'
  },
  iconPaths: {
    favicon32: 'img/icons/favicon-32x32.png',
    favicon16: 'img/icons/favicon-16x16.png',
    appleTouchIcon: 'img/icons/apple-touch-icon.png',
    maskIcon: 'img/icons/safari-pinned-tab.svg',
    msTileImage: 'img/icons/mstile-150x150.png'
  }
}