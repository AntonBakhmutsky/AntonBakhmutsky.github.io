import Vue from 'vue'
import VueYandexMetrika from 'vue-yandex-metrika'

if (process.env.VUE_APP_YANDEX_METRIKA_ID) {
  Vue.use(VueYandexMetrika, {
    id: process.env.VUE_APP_YANDEX_METRIKA_ID,
    env: process.env.NODE_ENV,
    options: {
      clickmap: true,
      trackLinks: true,
      accurateTrackBounce: true,
      webvisor: true
    }
  })
}
