<template lang="pug">

li
  BaseCard
    div
      header
        h3 {{ title }}
        BaseButton(mode="flat") Delete
    p {{ description }}
    nav
      a(:href="link") View resource

</template>

<script>

export default {
  props: ['title', 'description', 'link']
}
</script>

<style lang="sass" scoped>
li
  margin: auto
  max-width: 40rem

header
  display: flex
  justify-content: space-between
  align-items: center

h3
  font-size: 1.25rem
  margin: 0.5rem 0

p
  margin: 0.5rem 0

a
  text-decoration: none
  color: #ce5c00

  &:hover, &:active
    color: #c89300
</style>