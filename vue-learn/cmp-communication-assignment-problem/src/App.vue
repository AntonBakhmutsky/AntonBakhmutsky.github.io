<template lang="pug">

header
  h1 Vue assignment
main
  active-user(:user-name="user.name" :user-age="user.age")
  user-data(@set-name-and-age="getNameAndAge")

</template>

<script>
export default {
  data() {
    return {
      user: {
        name: 'Anton',
        age: 36
      }
    }
  },
  methods: {
    getNameAndAge(userName, userAge) {
      if (userName && userAge) {
        this.user.name = userName;
        this.user.age = Number(userAge);
      } else {
        alert('Full all fields!')
      }
    }
  }
}
</script>

<style lang="sass">
  #app
    max-width: 40rem
    width: 100%
    box-sizing: border-box
    margin: 0 auto
    font-family: Arial, sans-serif
    font-size: 18px

    h1
      font-size: 48px
      text-align: center
      color: #42b883
</style>