<template lang="pug">
BaseContainer(title="Vuex")
  TheCounter
  button(@click="addOne") Add 10
  ChangeCounter
</template>

<script>
import BaseContainer from './components/BaseContainer.vue';
import TheCounter from "@/components/TheCounter";
import ChangeCounter from "@/components/ChangeCounter";

export default {
  components: {
    BaseContainer,
    TheCounter,
    ChangeCounter
  },
  methods: {
    addOne() {
      // this.$store.commit('increase', {value: 10});
      this.$store.commit({
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