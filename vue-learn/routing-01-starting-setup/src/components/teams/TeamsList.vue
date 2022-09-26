<template lang="pug">
ul
  TeamsItem(
    v-for="team in teams"
    :key="team.id"
    :id="team.id"
    :name="team.name"
    :member-count="team.members.length"
  )
</template>

<script>
import TeamsItem from './TeamsItem.vue';

export default {
  components: {
    TeamsItem,
  },
  inject: ['teams'],
};
</script>

<style lang="sass" scoped>
ul
  list-style: none
  margin: 2rem auto
  max-width: 40rem
  padding: 0
</style>