import i18n from '@/plugins/i18n'

export default {
  namespaced: true,
  state: {
    menu: [
      { title: i18n.t('products.title'), to: { name: 'home', hash: '#products' } },
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
        counter: i18n.t('socials.vk.counter')
      },
      {
        code: 'facebook',
        href: i18n.t('socials.facebook.href'),
        text: i18n.t('socials.facebook.text'),
        counter: i18n.t('socials.facebook.counter')
      },
      {
        code: 'instagram',
        href: i18n.t('socials.instagram.href'),
        text: i18n.t('socials.instagram.text'),
        counter: i18n.t('socials.instagram.counter')
      },
      {
        code: 'youtube',
        href: i18n.t('socials.youtube.href'),
        text: i18n.t('socials.youtube.text')
      }
    ],
    languages: [
      { locale: 'en', title: 'en' },
      { locale: 'ru', title: 'ru' },
      { locale: 'kz', title: 'kz' },
      { locale: 'by', title: 'by' },
      { locale: 'ua', title: 'ua' }
    ]
  }
}
