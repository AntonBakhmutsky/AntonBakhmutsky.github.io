<template lang="pug">

ul
  li(:class="{active: modelValue === 'poor'}")
    button(type="button" @click="activate('poor')") Poor
  li(:class="{active: modelValue === 'average'}")
    button(type="button" @click="activate('average')")  Average
  li(:class="{active: modelValue === 'great'}")
    button(type="button" @click="activate('great')") Great

</template>

<script>
export default {
  props: ['modelValue'],
  emits: ['update:modelValue'],
  // data() {
  //   return {
  //     activeOption: this.modelValue
  //   }
  // },
  // computed: {
  //   activeOption() {
  //     return this.modelValue;
  //   }
  // },
  methods: {
    activate(option) {
      this.$emit('update:modelValue', option);
    },
  },
}
</script>

<style lang="sass" scoped>
  ul
    list-style: none
    margin: .5rem 0
    padding: 0
    display: flex

    li
      margin: 0 1rem
      border: 1px solid #ccc
      display: flex
      justify-content: center
      align-items: center

      button
        font: inherit
        border: none
        background-color: transparent
        cursor: pointer
        padding: 1rem

  .active
    border-color: #a00078

    button
      color: #a00078
</style>