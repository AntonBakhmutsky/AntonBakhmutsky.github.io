export default {
  logIn(context) {
    context.commit('setAuth', {value: true});
  },
  logOut(context) {
    context.commit('setAuth', {value: false});
  }
}
