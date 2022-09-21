<template lang="pug">

BaseCard
  form
    .form-control
      label(for="title") Title
      input#title(name="title" type="text")
    .form-control
      label(for="description") Description
      textarea#description(name="description" rows="3")
    .form-control
      label(for="link") Title
      input#link(name="link" type="url")
    div
      BaseButton(type="submit") Add Resource

</template>

<script>
export default {}
</script>

<style lang="sass" scoped>
label
  font-weight: bold
  display: block
  margin-bottom: 0.5rem

input, textarea
  display: block
  width: 100%
  font: inherit
  padding: 0.15rem
  border: 1px solid #ccc

input:focus, textarea:focus
  outline: none
  border-color: #3a0061
  background-color: #f7ebff

.form-control
  margin: 1rem 0
</style>