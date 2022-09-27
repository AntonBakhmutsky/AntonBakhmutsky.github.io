<template lang="pug">
header
  h1
    RouterLink(to='/') VueShop
  nav
    ul
      li
        RouterLink(to='/products') Products
      li
        RouterLink(to='/cart') Cart
        BaseBadge(mode='elegant') {{ getCartQty }}
      li(v-if='isAuth')
        RouterLink(to='/admin') Admin
  div
    button(v-if='!isAuth' @click='logIn') Login
    button(v-if='isAuth' @click='logOut') Logout
</template>

<script>
import {mapActions, mapGetters} from 'vuex'

export default {
  methods: {
    ...mapActions('auth', ['logIn', "logOut"])
  },
  computed: {
    ...mapGetters('auth', ['isAuth']),
    ...mapGetters('cart', ['getCart', 'getCartQty'])
  }
};
</script>

<style scoped lang="sass">
header
  height: 5rem
  background-color: white
  margin: 0 10%
  display: flex
  justify-content: space-between
  align-items: center

ul
  list-style: none
  margin: 0
  padding: 0
  display: flex
  justify-self: center
  align-items: center

li
  margin: 0 1rem

a
  text-decoration: none
  color: #333
  font-weight: bold
  border-bottom: 2px solid transparent
  padding-bottom: 0.25rem

  &:hover, &:active, &.router-link-active
    color: #45006d
    border-color: #45006d

button
  font: inherit
  cursor: pointer
  padding: 0.5rem 1.5rem
  border: 1px solid #45006d
  background-color: transparent
  color: #45006d
  border-radius: 30px

  &:hover, &:active
    background-color: #f0d5ff
</style>