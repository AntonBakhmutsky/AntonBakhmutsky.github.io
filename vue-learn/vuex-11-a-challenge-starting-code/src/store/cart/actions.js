export default {
  addProductToCart(context, payload) {
    const prodId = payload.id;
    const products = context.rootGetters['products/getProducts'];
    const product = products.find(el => el.id === prodId);
    context.commit('addProductToCart', product);
  },
  removeProductFromCart(context, payload) {
    context.commit('removeProductFromCart', payload);
  }
}
