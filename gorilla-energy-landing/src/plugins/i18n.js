import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)

function loadLocaleMessages () {
  const locales = require.context('../locales', true, /[A-Za-z0-9-_,\s]+\.json$/i)
  const messages = {}
  locales.keys().forEach(key => {
    const matched = key.match(/([A-Za-z0-9-_]+)\./i)
    if (matched && matched.length > 1) {
      const locale = matched[1]
      messages[locale] = locales(key)
    }
  })
  return messages
}

function slavicPluralization (choice, choicesLength) {
  if (choice === 0) {
    return 0
  }

  const teen = choice > 10 && choice < 20
  const endsWithOne = choice % 10 === 1

  if (choicesLength < 4) {
    return (!teen && endsWithOne) ? 1 : 2
  }

  if (!teen && endsWithOne) {
    return 1
  }

  if (!teen && choice % 10 >= 2 && choice % 10 <= 4) {
    return 2
  }

  return (choicesLength < 4) ? 2 : 3
}

export default new VueI18n({
  locale: localStorage.getItem('locale') || 'en',
  fallbackLocale: 'en',
  messages: loadLocaleMessages(),
  pluralizationRules: {
    'ru': slavicPluralization,
    'kz': slavicPluralization
  }
})
