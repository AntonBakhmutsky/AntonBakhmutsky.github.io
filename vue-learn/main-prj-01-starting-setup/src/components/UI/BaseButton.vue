<template lang="pug">
button(v-if="!link" :class="mode")
  slot
RouterLink(v-else :to="to" :class="mode")
  slot
</template>

<script>
export default {
  props: {
    mode: {
      type: String,
      required: false,
      default: null
    },
    link: {
      type: Boolean,
      required: false
    },
    to: {
      type: String,
      required: false,
      default: '/'
    }
  }
}
</script>

<style lang="sass" scoped>
button
  text-decoration: none
  padding: 0.75rem 1.5rem
  font: inherit
  background-color: #3a0061
  border: 1px solid #3a0061
  color: white
  cursor: pointer
  border-radius: 30px
  margin-right: 0.5rem
  display: inline-block

a
  text-decoration: none
  padding: 0.75rem 1.5rem
  font: inherit
  background-color: #3a0061
  border: 1px solid #3a0061
  color: white
  cursor: pointer
  border-radius: 30px
  margin-right: 0.5rem
  display: inline-block

  &:hover, &:active
    background-color: #270041
    border-color: #270041

button
  &:hover, &:active
    background-color: #270041
    border-color: #270041

.flat
  background-color: transparent
  color: #3a0061
  border: none

.outline
  background-color: transparent
  border-color: #270041
  color: #270041

.flat
  &:hover, &:active
    background-color: #edd2ff

.outline
  &:hover, &:active
    background-color: #edd2ff
</style>