<template lang="pug">
section
  h2 Your Cart
  h3 Total Amount:
    BaseBadge(mode='elegant') ${{ cartTotal }}
  ul
    CartItem(
      v-for='item in cart.items'
      :key='item.productId'
      :prod-id='item.productId'
      :title='item.title'
      :image='item.image'
      :price='item.price'
      :qty='item.qty'
    )
</template>

<script>
import CartItem from '../components/cart/CartItem.vue';

export default {
  inject: ['cart'],
  components: {
    CartItem,
  },
  computed: {
    cartTotal() {
      return this.cart.total.toFixed(2);
    }
  }
};
</script>

<style scoped lang="sass">
section
  margin: 2rem auto
  max-width: 40rem

h2
  color: #292929
  text-align: center
  border-bottom: 2px solid #ccc
  padding-bottom: 1rem

h3
  text-align: center

ul
  list-style: none
  margin: 0
  padding: 0
</style>