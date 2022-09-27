<template lang="pug">
button(@click="increment") Add 2
button(@click="increase({value: 11})") Add 2
</template>

<script>
import {mapActions} from 'vuex';

export default {
  methods: {
    // addOne() {
    //   this.$store.dispatch('increment');
    // },
    ...mapActions(['increment', 'increase'])
  }
}
</script>