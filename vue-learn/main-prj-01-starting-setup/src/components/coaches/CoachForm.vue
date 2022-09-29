<template lang="pug">
form(@submit.prevent="submitForm")
  .form-control
    label(for="firstname") Firstname
    input#firstname(type="text" placeholder="Enter your firstname" v-model.trim="firstName")
  .form-control
    label(for="lastname") Lastname
    input#lastname(type="text" placeholder="Enter your lastname" v-model.trim="lastName")
  .form-control
    label(for="description") Description
    textarea#description(placeholder="description" rows="5" v-model.trim="description")
  .form-control
    label(for="rate") Hourly Rate
    input#rate(type="number" placeholder="Enter your hourly rate" v-model.number="rate")
  .form-control
    h3 Areas of Expertise
    div
      input#frontend(type="checkbox" value="frontend" v-model="areas")
      label(for="frontend") Frontend Development
    div
      input#backend(type="checkbox" value="backend" v-model="areas")
      label(for="backend") Backend Development
    div
      input#career(type="checkbox" value="career" v-model="areas")
      label(for="career") Career Advisory
  BaseButton Register
</template>

<script>
export default {
  data() {
    return {
      firstName: '',
      lastName: '',
      description: '',
      rate: '',
      areas: []
    }
  },
  methods: {
    submitForm() {
      const formData = {
        first: this.firstName,
        last: this.lastName,
        desc: this.description,
        rate: this.rate,
        areas: this.areas
      }
      console.log(formData);
    },
  }
}
</script>

<style lang="sass" scoped>
.form-control
  margin: 0.5rem 0

label
  font-weight: bold
  display: block
  margin-bottom: 0.5rem

input
  &[type='checkbox'] + label
    font-weight: normal
    display: inline
    margin: 0 0 0 0.5rem

  display: block
  width: 100%
  border: 1px solid #ccc
  font: inherit

textarea
  display: block
  width: 100%
  border: 1px solid #ccc
  font: inherit

input:focus, textarea:focus
  background-color: #f0e6fd
  outline: none
  border-color: #3d008d

input[type='checkbox']
  display: inline
  width: auto
  border: none

  &:focus
    outline: #3d008d solid 1px

h3
  margin: 0.5rem 0
  font-size: 1rem

.invalid
  label
    color: red

  input, textarea
    border: 1px solid red
</style>