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
      const updatedFilters = {
        ...this.filters,
        [inputId]: isActive
      }
      this.filters = updatedFilters;
      this.$emit('change-filter', updatedFilters);
    },
  }
}
</script>

<style lang="sass" scoped>
h2
  margin: 0.5rem 0

.filter-option
  margin-right: 1rem

  label, input
    vertical-align: middle

  label
    margin-left: 0.25rem

  &.active label
    font-weight: bold
</style>