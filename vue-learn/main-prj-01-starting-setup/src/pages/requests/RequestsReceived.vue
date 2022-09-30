<template lang="pug">
div
  BaseDialog(:show="!!error" title="An error occurred!" @close="handleError")
    p {{ error }}
  section
    BaseCard
      header
        h2 Requests Received
      BaseSpinner(v-if="isLoading")
      ul(v-else-if="hasRequests && !isLoading")
        RequestItem(v-for="req in receivedRequests" :key="req.id" :email="req.userEmail", :message="req.message")
      h3(v-else) You haven't received any request yet!
</template>

<script>
import RequestItem from '@/components/requests/RequestItem';

export default {
  components: {
    RequestItem
  },
  data() {
    return {
      isLoading: false,
      error: null
    }
  },
  computed: {
    receivedRequests() {
      return this.$store.getters['requests/requests'];
    },
    hasRequests() {
      return this.$store.getters['requests/hasRequests'];
    },
  },
  created() {
    this.loadRequests();
  },
  methods: {
    async loadRequests() {
      this.isLoading = true;
      try {
        await this.$store.dispatch('requests/fetchRequests')
      } catch (error) {
        this.error = error.message || 'Something failed';
      }
      this.isLoading = false;
    },
    handleError() {
      this.error = null;
    }
  },
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