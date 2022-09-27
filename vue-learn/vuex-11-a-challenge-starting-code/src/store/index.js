import Vuex from 'vuex';

import products from './products/index';
import cart from './cart/index';
import auth from './auth/index';

export default new Vuex.Store({
  modules: {
    auth,
    products,
    cart
  }
})
