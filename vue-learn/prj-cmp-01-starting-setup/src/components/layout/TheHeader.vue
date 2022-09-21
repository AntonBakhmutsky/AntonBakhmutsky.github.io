<template lang="pug">

header
  h1 {{ title }}

</template>

<script>
export default {
  props: ['title']
}
</script>

<style lang="sass" scoped>
header
  width: 100%
  height: 5rem
  background-color: #640032
  display: flex
  justify-content: center
  align-items: center

  h1
    color: white
    margin: 0
</style>