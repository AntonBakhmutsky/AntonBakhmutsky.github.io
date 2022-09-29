<template lang="pug">
section
  BaseCard
    header
      h2 Requests Received
    ul(v-if="hasRequests")
      RequestItem(v-for="req in receivedRequests" :key="req.id" :email="req.userEmail", :message="req.message")
    h3(v-else) You haven't received any request yet!
</template>

<script>
import RequestItem from '@/components/requests/RequestItem';

export default {
  components: {
    RequestItem
  },
  computed: {
    receivedRequests() {
      return this.$store.getters['requests/requests'];
    },
    hasRequests() {
      return this.$store.getters['requests/hasRequests'];
    },
  }
}
</script>

<style lang="sass" scoped>
header
  text-align: center

ul
  list-style: none
  margin: 2rem auto
  padding: 0
  max-width: 30rem

h3
  text-align: center
</style>