<template lang="pug">

BaseCard
  form(@submit.prevent="submitData" ref="form")
    .form-control
      label(for="title") Title
      input#title(name="title" type="text" required v-model="enteredTitle")
    .form-control
      label(for="description") Description
      textarea#description(name="description" rows="3" required v-model="enteredDescription")
    .form-control
      label(for="link") Link
      input#link(name="link" type="url" required v-model="enteredLink")
    div
      BaseButton(type="submit") Add Resource

</template>

<script>
export default {
  data() {
    return {
      enteredTitle: '',
      enteredDescription: '',
      enteredLink: ''
    }
  },
  methods: {
    submitData() {
      this.$emit('add-resource', this.enteredTitle, this.enteredDescription, this.enteredLink);
      this.$refs.form.reset();
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