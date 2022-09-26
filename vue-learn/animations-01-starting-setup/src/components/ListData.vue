<template lang="pug">
transition-group(tag="ul" name="list")
  li(v-for="user in users" :key="user" @click="removeUser(user)") {{ user }}
div
  input(type="text" name="text" placeholder="text" v-model="newUser")
  button(@click="addUser") Add User
</template>

<script>
export default {
  data() {
    return {
      users: ['Max', 'Manu', 'Julie', 'Angela', 'Michael'],
      newUser: '',
    }
  },
  methods: {
    removeUser(user) {
     this.users = this.users.filter(el => el !== user);
    },
    addUser() {
      this.users.unshift(this.newUser);
      this.newUser = '';
    },
  }
}
</script>

<style lang="sass" scoped>
ul
  list-style: none
  margin: 0
  padding: 0

  li
    border: 1px solid #ccc
    padding: 1rem
    text-align: center

div
  display: flex
  flex-direction: column
  margin-top: 20px

  input
    height: 30px
    font-size: 20px

  button
    margin-top: 10px

.list-enter-from
  opacity: 0
  transform: translateX(-30px)

.list-enter-active
  transition: 1s

.list-enter-to
  opacity: 1
  transform: translateX(0)

.list-leave-from
  opacity: 1
  transform: translateX(0)

.list-leave-active
  transition: 1s

.list-leave-to
  opacity: 0
  transform: translateX(-30px)

</style>