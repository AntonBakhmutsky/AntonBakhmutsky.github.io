<template lang="pug">
teleport(to="body")
  BaseDialog(v-if="inputIsInvalid" title="Invalid input" @close="confirmError")
    template(#default)
      p Unfortunately, at least one input value is invalid.
      p Please check all inputs and make sure you enter at least a few characters into each input fields.
    template(#actions)
      BaseButton(@click="confirmError") Okay
BaseCard
  form(@submit.prevent="submitData" ref="form")
    .form-control
      label(for="title") Title
      input#title(name="title" type="text" ref="titleInput")
    .form-control
      label(for="description") Description
      textarea#description(name="description" rows="3" ref="descriptionInput")
    .form-control
      label(for="link") Link
      input#link(name="link" type="url" ref="linkInput")
    div
      BaseButton(type="submit") Add Resource
</template>

<script>
export default {
  inject: ['addItem'],
  data() {
    return {
      inputIsInvalid: false
    }
  },
  methods: {
    submitData() {
      const enteredTitle = this.$refs.titleInput.value;
      const enteredDescription = this.$refs.descriptionInput.value;
      const enteredLink = this.$refs.linkInput.value;

      if (enteredTitle.trim === '' || enteredDescription.trim() === '' || enteredLink.trim() === '') {
        this.inputIsInvalid = true;
        return;
      } else {
        this.addItem(enteredTitle, enteredDescription, enteredLink);
      }
    },
    confirmError() {
      this.inputIsInvalid = false;
    }
  }
}
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