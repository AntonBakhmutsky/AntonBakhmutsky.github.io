import {createStore} from "vuex";

import rootMutations from './mutations';
import rootActions from './actions';
import rootGetters from './getters'
import counterModule from './number/index';

const store = createStore({
  modules: {
    numbers: counterModule
  },
  state() {
    return {
      counter: 0,
      userAuth: false
    }
  },
  mutations: rootMutations,
  actions: rootActions,
  getters: rootGetters
});

export default store
