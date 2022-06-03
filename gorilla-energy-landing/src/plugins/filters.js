import Vue from 'vue'
import moment from 'moment'
import i18n from '@/plugins/i18n'

let locale = 'en'

switch (i18n.locale) {
  case 'ru':
  case 'by':
    locale = 'ru'
    break
  case 'kz':
    locale = 'kk'
    break
}

moment.locale(locale)

Vue.filter('date', function (value) {
  if (!value) {
    return null
  }
  return moment(value).format('DD MMMM YYYY')
})

Vue.filter('filesize', function (num) {
  if (typeof num !== 'number' || isNaN(num)) {
    throw new TypeError('Expected a number')
  }

  let exponent
  let unit
  let neg = num < 0
  let units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']

  if (neg) {
    num = -num
  }

  if (num < 1) {
    return (neg ? '-' : '') + num + ' B'
  }

  exponent = Math.min(Math.floor(Math.log(num) / Math.log(1000)), units.length - 1)
  num = (num / Math.pow(1000, exponent)).toFixed(2) * 1
  unit = units[exponent]

  return (neg ? '-' : '') + num + ' ' + unit
})
