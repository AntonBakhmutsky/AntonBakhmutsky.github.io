<template lang="pug">
li
  h3 {{ fullName }}
  h4 {{ rate }}/hour
  div
    BaseBadge(v-for="area in areas" :key="area" :class="area" :title="area")
  .actions
    BaseButton(:to="coachContactLink" link mode="outline") Contact
    BaseButton(:to="coachDetailsLink" link) View Details
</template>

<script>
export default {
  props: ['id', 'firstName', 'lastName', 'rate', 'areas'],
  computed: {
    fullName() {
      return `${this.firstName} ${this.lastName}`;
    },
    coachContactLink() {
      return `${this.$route.path}/${this.id}/contact`;
    },
    coachDetailsLink() {
      return `${this.$route.path}/${this.id}`;
    }
  }
}
</script>

<style lang="sass" scoped>
li
  margin: 1rem 0
  border: 1px solid #424242
  border-radius: 12px
  padding: 1rem

h3
  font-size: 1.5rem
  margin: 0.5rem 0

h4, div
  margin: 0.5rem 0

.actions
  display: flex
  justify-content: flex-end
</style>