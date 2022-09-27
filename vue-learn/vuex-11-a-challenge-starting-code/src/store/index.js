import Vuex from 'vuex';

import products from './products/index';
import cart from './cart/index';

export default new Vuex.Store({
  modules: {
    products,
    cart
  }
})
