<template lang="pug">
header
  nav
    h1
      RouterLink(to="/") Find a coach
    ul
      li
        RouterLink(to="/coaches") All coaches
      li(v-if="isLoggedIn")
        RouterLink(to="/requests") Requests
      li(v-else)
        RouterLink(to="/auth") Login
      li(v-if="isLoggedIn")
        BaseButton(@click="logout") Logout

</template>

<script>
export default {
  computed: {
    isLoggedIn() {
      return this.$store.getters.isAuthenticated;
    }
  },
  methods: {
    logout() {
      this.$store.dispatch('logout');
      this.$router.replace('/coaches');
    }
  }
}
</script>

<style lang="sass" scoped>
header
  width: 100%
  height: 5rem
  background-color: #3d008d
  display: flex
  justify-content: center
  align-items: center

  a
    text-decoration: none
    color: #f391e3
    display: inline-block
    padding: 0.75rem 1.5rem
    border: 1px solid transparent

a
  &:active, &:hover, &.router-link-active
    border: 1px solid #f391e3

h1
  margin: 0

  a
    color: white
    margin: 0

    &:hover, &:active, &.router-link-active
      border-color: transparent

header
  nav
    width: 90%
    margin: auto
    display: flex
    justify-content: space-between
    align-items: center

  ul
    list-style: none
    margin: 0
    padding: 0
    display: flex
    justify-content: center
    align-items: center

li
  margin: 0 0.5rem
</style>