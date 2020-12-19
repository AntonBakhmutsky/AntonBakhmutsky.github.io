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