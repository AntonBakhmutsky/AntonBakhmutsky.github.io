<template lang="pug">

header
  h1 Vue assignment
main
  active-user(:user-name="name" :user-age="age")
  user-data(@set-name-and-age="getNameAndAge")

</template>

<script>
export default {
  data() {
    return {
      name: 'Anton',
      age: '36'
    }
  },
  methods: {
    getNameAndAge(userName, userAge) {
      this.name = userName;
      this.age = userAge;
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