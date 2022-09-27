<template lang="pug">
h3 {{ finalCounter }}
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  computed: {
    // counter() {
    //   return this.$store.state.counter * 2;
    // }
    ...mapGetters(['finalCounter'])
  },
}
</script>