<template lang="pug">

section.active-user
  h2 User name: {{ userName }}
  h3 User age: {{ userAge }}
</template>

<script>
export default {
  props: {
    userName: {
      type: String,
      required: false,
    },
    userAge: {
      type: Number,
      required: false,
    }
  }
}
</script>

<style lang="sass">
  .active-user
    h2, h3
      height: 50px
      border-radius: 20px
      background-color: #42b883
      color: #fff
      display: flex
      align-items: center
      justify-content: center
</style>