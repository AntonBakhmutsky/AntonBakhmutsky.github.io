<template lang="pug">
main
  AddUser
  DeleteUser
</template>

<script>
import AddUser from './components/AddUser.vue';
import DeleteUser from './components/DeleteUser.vue';

export default {
  components: {
    AddUser,
    DeleteUser,
  },
};
</script>

<style lang="sass">
*
  box-sizing: border-box

html
  font-family: sans-serif

body
  margin: 0

main
  width: 40rem
  margin: 3rem auto

section
  margin: 2rem auto
  border: 1px solid #ccc
  border-radius: 12px
  padding: 1rem

button
  font: inherit
  background-color: #310131
  border: 1px solid #310131
  border-radius: 8px
  color: white
  padding: 0.5rem 1.5rem
  cursor: pointer

  &:hover, &:active
    background-color: #770e77
    border-color: #770e77
</style>