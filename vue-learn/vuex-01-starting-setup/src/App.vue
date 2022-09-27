<template lang="pug">
BaseContainer(title="Vuex")
  TheCounter
  FavoriteValue
  button(@click="addOne") Add 10
  ChangeCounter
</template>

<script>
import BaseContainer from './components/BaseContainer.vue';
import TheCounter from "@/components/TheCounter";
import ChangeCounter from "@/components/ChangeCounter";
import FavoriteValue from "@/components/FavoriteValue";

export default {
  components: {
    BaseContainer,
    TheCounter,
    ChangeCounter,
    FavoriteValue
  },
  methods: {
    addOne() {
      // this.$store.dispatch('increase', {value: 10});
      this.$store.dispatch({
        type: 'increase',
        value: 10
      })
    },
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