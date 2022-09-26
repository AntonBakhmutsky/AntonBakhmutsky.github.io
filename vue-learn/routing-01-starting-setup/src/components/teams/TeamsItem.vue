<template lang="pug">
li
  h3 {{ name }}
  div(class="team-members") {{ memberCount }} Members
  RouterLink(:to="`/teams/${id}`") View Members
</template>

<script>
export default {
  props: ['id', 'name', 'memberCount'],
};
</script>

<style lang="sass" scoped>
li
  margin: 1rem 0
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26)
  border-radius: 12px
  padding: 1rem

  h3
    margin: 0.5rem 0
    font-size: 1.25rem

  .team-members
    margin: 0.5rem 0

a
  text-decoration: none
  color: white
  display: inline-block
  padding: 0.5rem 1.5rem
  background-color: #11005c

  &:hover, &:active
    background-color: #220a8d
</style>