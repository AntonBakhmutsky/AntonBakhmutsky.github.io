import i18n from '@/plugins/i18n'

export default {
  namespaced: true,
  mutations: {
    SET_LANGUAGES (state, items) {
      state.languages = items.map(value => ({
        locale: value,
        title: value
      }))
    }
  },
  state: {
    menu: [
      { title: i18n.t('products.title'), to: { name: 'home', hash: '#products' } },
      { title: i18n.te('rappers.title') ? i18n.t('rappers.title') : false, to: { name: 'home', hash: '#rappers' } },
      { title: i18n.t('riders.title'), to: { name: 'home', hash: '#riders' } },
      { title: i18n.t('fighters.title'), to: { name: 'home', hash: '#fighters' } },
      { title: i18n.t('news.title'), to: { name: 'home', hash: '#news' } },
      { title: i18n.t('contacts.title'), to: { name: 'home', hash: '#contacts' } },
      { title: i18n.t('map.title'), to: { name: 'home', hash: '#map' } }
    ],
    socials: [
      {
        code: 'vk',
        href: i18n.t('socials.vk.href'),
        text: i18n.t('socials.vk.text'),
        counter: i18n.t('socials.vk.counter'),
        hide: i18n.locale === 'ua'
      },
      {
        code: 'telegram',
        href: i18n.t('socials.telegram.href'),
        text: i18n.t('socials.telegram.text')
      },
      {
        code: 'youtube',
        href: i18n.t('socials.youtube.href'),
        text: i18n.t('socials.youtube.text')
      }
    ],
    languages: []
  }
}
