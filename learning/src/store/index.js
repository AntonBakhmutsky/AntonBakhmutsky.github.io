import Vue from 'vue'
import Vuex from 'vuex'

import main from './main'
import products from './products'
import riders from './riders'
import fighters from './fighters'
import news from './news'
import socials from './socials'
import map from './map'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    main,
    products,
    riders,
    fighters,
    news,
    socials,
    map
  }
})
