<template lang="pug">
BaseDialog(:show="!!error" title="An error occurred!" @close="handleError")
  p {{ error }}
section
  CoachFilter(@change-filter="setFilters")
section
  BaseCard
    .controls
      BaseButton(mode="outline" @click="loadCoaches(true)") Refresh
      BaseButton(to="/register" link v-if="!isCoach && !isLoading") Register as Coach
    div(v-if="isLoading")
      BaseSpinner
    ul(v-else-if="hasCoaches")
      CoachItem(
        v-for="coach in filteredCoaches"
        :key="coach.id"
        :id="coach.id"
        :first-name="coach.firstName"
        :last-name="coach.lastName"
        :rate="coach.hourlyRate"
        :areas="coach.areas"
      )
    h3(v-else) No coaches found.
</template>

<script>
import CoachItem from '@/components/coaches/CoachItem';
import CoachFilter from '@/components/coaches/CoachFilter';

export default {
  components: {
    CoachItem,
    CoachFilter
  },
  data() {
    return {
      isLoading: false,
      error: null,
      activeFilters: {
        frontend: true,
        backend: true,
        career: true
      },
    }
  },
  computed: {
    filteredCoaches() {
      const coaches = this.$store.getters['coaches/coaches'];
      return coaches.filter(coach => {
        if (this.activeFilters.frontend && coach.areas.includes('frontend')) {
          return true;
        }
        if (this.activeFilters.backend && coach.areas.includes('backend')) {
          return true;
        }
        return this.activeFilters.career && coach.areas.includes('career');
      });
    },
    hasCoaches() {
      return !this.isLoading && this.$store.getters['coaches/hasCoaches'];
    },
    isCoach() {
      return this.$store.getters['coaches/isCoach'];
    }
  },
  created() {
    this.loadCoaches();
  },
  methods: {
    setFilters(updatedFilters) {
      this.activeFilters = updatedFilters;
    },
    async loadCoaches(refresh = false) {
      this.isLoading = true;
      try {
        await this.$store.dispatch('coaches/loadCoaches', {forceRefresh: refresh});
      } catch (error) {
        this.error = error.message || 'Something went wrong!'
      }
      this.isLoading = false;
    },
    handleError() {
      this.error = null;
    },
  },
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