<template lang="pug">
button(@click="addOne") Add 2
</template>

<script>
export default {
  methods: {
    addOne() {
      this.$store.dispatch('increment');
    },
  }
}
</script>