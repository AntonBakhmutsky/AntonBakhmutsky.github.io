<template lang="pug">
BaseCard
  h2 Find Your Coach
  span.filter-option
    input#frontend(type="checkbox" checked @change="setFilter")
    label(for="frontend") Frontend
  span.filter-option
    input#backend(type="checkbox" checked @change="setFilter")
    label(for="backend") Backend
  span.filter-option
    input#career(type="checkbox" checked @change="setFilter")
    label(for="career") Career
</template>

<script>
export default {
  emits: ['change-filter'],
  data() {
    return {
      filters: {
        frontend: true,
        backend: true,
        career: true
      }
    }
  },
  methods: {
    setFilter(event) {
      const inputId = event.target.id;
      const isActive = event.target.checked;
      const updateFilters = {
        ...this.filters,
        [inputId]: isActive
      }
      this.filters = updateFilters;
      this.$emit('change-filter', updateFilters)
    },
  }
}
</script>