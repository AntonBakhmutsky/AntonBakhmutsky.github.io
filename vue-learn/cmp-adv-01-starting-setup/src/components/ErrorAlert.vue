<template lang="pug">

dialog(open)
  slot

</template>

<style lang="sass" scoped>
  dialog
    margin: 0
    position: fixed
    top: 20vh
    left: 30%
    width: 40%
    background-color: #fff
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26)
    padding: 1rem
</style>