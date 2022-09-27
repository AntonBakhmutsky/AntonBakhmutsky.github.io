<template lang="pug">
h3 {{ counter }}
p We do more...
</template>

<script>
export default {
  computed: {
    counter() {
      return this.$store.getters['numbers/normalizedCounter'];
    }
  },
}
</script>