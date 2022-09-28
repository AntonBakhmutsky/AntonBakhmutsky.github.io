<template lang="pug">
section FILTER
section
  .controls
    button() Refresh
    RouterLink(to="/register") Register as Coach
  ul(v-if="hasCoaches")
    CoachItem(
      v-for="coach in filteredCoaches"
      :key="coach.id"
      :id="coach.id"
      :first-name="coach.firstName"
      :last-name="coach.lastName"
      :rate="coach.hourlyRate"
      :areas="coach.areas"
    )
  h3 No coaches found.
</template>

<script>
import CoachItem from '@/components/coaches/CoachItem';

export default {
  components: {CoachItem},
  computed: {
    filteredCoaches() {
      return this.$store.getters['coaches/coaches'];
    },
    hasCoaches() {
      return this.$store.getters['coaches/hasCoaches'];
    }
  }
}
</script>

<style lang="sass" scoped>
ul
  list-style: none
  margin: 0
  padding: 0

.controls
  display: flex
  justify-content: space-between
</style>