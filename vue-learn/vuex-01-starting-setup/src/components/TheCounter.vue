<template lang="pug">
h3 {{ counter }}
</template>

<script>
export default {
  computed: {
    counter() {
      return this.$store.state.counter;
    }
  },
}
</script>