<template lang="pug">

section.user-data
  div
    label(for="name") User name:
    input#name(type="text" v-model="enteredName" @input="setNameAndAge")
  div
    label(for="age") User age:
    input#age(type="text" v-model="enteredAge" @input="setNameAndAge")
</template>

<script>
export default {
  data() {
    return {
      enteredName: '',
      enteredAge: ''
    }
  },
  methods: {
    setNameAndAge() {
      this.$emit('set-name-and-age', this.enteredName, this.enteredAge)
    }
  }
}
</script>

<style lang="sass">
  .user-data
    margin-top: 40px

    div
      display: flex
      flex-direction: column
      font-size: 26px
      font-weight: 700
      margin-bottom: 20px

    input
      height: 40px
      font-size: 26px

    label
      margin-bottom: 5px
</style>