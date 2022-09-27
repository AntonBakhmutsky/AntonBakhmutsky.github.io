import numberMutations from'./mutations';
import numberActions from'./actions';
import numberGetters from'./getters';

export default {
  namespaced: true,
  state() {
    return {
      counter: 0
    }
  },
  mutations: numberMutations,
  actions: numberActions,
  getters: numberGetters
}
