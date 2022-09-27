export default {
  getCart(state) {
    return state.cart;
  },
  getCartTotal(state) {
    return state.cart.total.toFixed(2);
  }
}
