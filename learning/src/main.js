import Vue from 'vue'
import App from './App.vue'
import store from './store/index'
import i18n from './plugins/i18n'

import './plugins/index'

Vue.config.productionTip = false

new Vue({
  i18n,
  store,
  render: h => h(App)
}).$mount('#app')
