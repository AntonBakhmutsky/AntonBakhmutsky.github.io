import Vue from 'vue'
import Vuex from 'vuex'

import main from './main'
import enums from './enums'
import fighters from './fighters'
import map from './map'
import news from './news'
import products from './products'
import rappers from './rappers'
import riders from './riders'
import siteVersions from './site-versions'
import socials from './socials'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    main,
    enums,
    fighters,
    map,
    news,
    products,
    rappers,
    riders,
    siteVersions,
    socials
  }
})
