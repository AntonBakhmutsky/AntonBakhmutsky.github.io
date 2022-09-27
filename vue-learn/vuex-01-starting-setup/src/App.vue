<template lang="pug">
BaseContainer(title="Vuex" v-if="userIsAuthenticated")
  TheCounter
  FavoriteValue
  button(@click="addOne") Add 10
  ChangeCounter
BaseContainer(title="Auth")
  UserAuth
</template>

<script>
import BaseContainer from './components/BaseContainer.vue';
import TheCounter from "@/components/TheCounter";
import ChangeCounter from "@/components/ChangeCounter";
import FavoriteValue from "@/components/FavoriteValue";
import UserAuth from "@/components/UserAuth";
import {mapGetters} from "vuex";

export default {
  components: {
    BaseContainer,
    TheCounter,
    ChangeCounter,
    FavoriteValue,
    UserAuth
  },
  methods: {
    addOne() {
      // this.$store.dispatch('increase', {value: 10});
      this.$store.dispatch({
        type: 'numbers/increase',
        value: 10
      })
    },
  },
  computed: {
    ...mapGetters(['userIsAuthenticated'])
  }
};
</script>

<style lang="sass">
*
  box-sizing: border-box

html
  font-family: sans-serif

body
  margin: 0
</style>