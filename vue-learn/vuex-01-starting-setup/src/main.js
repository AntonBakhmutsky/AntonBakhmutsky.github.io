import {createApp} from 'vue';
import {createStore} from 'vuex';

import App from './App.vue';

const counterModule = {
  namespaced: true,
  state() {
    return {
      counter: 0
    }
  },
  mutations: {
    increment(state) {
      state.counter += 2;
    },
    increase(state, payload) {
      console.log(state);
      state.counter += payload.value;
    },
  },
  actions: {
    increment(context) {
      setTimeout(function () {
        context.commit('increment');
      }, 2000)
    },
    increase(context, payload) {
      console.log(context);
      context.commit('increase', payload);
    },
  },
  getters: {
    finalCounter(state) {
      return state.counter * 2;
    },
    normalizedCounter(_, getters) {
      const finalCounter = getters.finalCounter;
      if (finalCounter < 0) {
        return 0;
      }
      if (finalCounter > 100) {
        return 100;
      }
      return finalCounter;
    },
  }
}

const app = createApp(App);

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
  mutations: {
    setAuth(state, payload) {
      state.userAuth = payload.isAuth;
    }
  },
  actions: {
    logIn(context) {
      context.commit('setAuth', {isAuth: true});
    },
    logOut(context) {
      context.commit('setAuth', {isAuth: false});
    }
  },
  getters: {
    userIsAuthenticated(state) {
      return state.userAuth;
    }
  }
});

app.use(store)
app.mount('#app');
