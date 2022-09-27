export default {
  getCart(state) {
    return state.items;
  },
  getCartTotal(state) {
    return state.total;
  },
  getCartQty(state) {
    return state.qty;
  }
}
