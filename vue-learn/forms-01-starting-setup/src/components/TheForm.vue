<template lang="pug">
form(@submit.prevent="submitForm")
  .form-control(:class="{invalid: userNameValidity === 'invalid'}")
    label(for='user-name') Your Name
    input#user-name(name='user-name' type='text' v-model.trim="userName" @blur="validateInput")
    p(v-if="userNameValidity === 'invalid'") Please enter a valid name!
  .form-control
    label(for='age') Your Age (Years)
    input#age(name='age' type='number' v-model="userAge")
  .form-control
    label(for='referrer') How did you hear about us?
    select#referrer(name='referrer' v-model="referrer")
      option(value='google') Google
      option(value='wom') Word of mouth
      option(value='newspaper') Newspaper
  .form-control
    h2 What are you interested in?
    div
      input#interest-news(name='interest' value="news" type='checkbox' v-model="interest")
      label(for='interest-news') News
    div
      input#interest-tutorials(name='interest' value="tutorials" type='checkbox' v-model="interest")
      label(for='interest-tutorials') Tutorials
    div
      input#interest-nothing(name='interest' value="nothing" type='checkbox' v-model="interest")
      label(for='interest-nothing') Nothing
  .form-control
    h2 How do you learn?
    div
      input#how-video(name='how' type='radio' value="video" v-model="how")
      label(for='how-video') Video Courses
    div
      input#how-blogs(name='how' type='radio' value="blogs" v-model="how")
      label(for='how-blogs') Blogs
    div
      input#how-other(name='how' type='radio' value="other" v-model="how")
      label(for='how-other') Other
  .form-control
    RatingControl(v-model="rating")
  .form-control
    input#confirm-terms(type="checkbox" name="confirm-terms" v-model="confirm")
    label(for="confirm-terms") Agree to terms of use?
  div
    button Save Data
</template>

<script>
import RatingControl from './RatingControl';
export default {
  components: {RatingControl},
  data() {
    return {
      userName: '',
      userAge: null,
      referrer: 'wom',
      interest: [],
      how: null,
      confirm: false,
      userNameValidity: 'pending',
      rating: null
    }
  },
  methods: {
    submitForm() {
      this.userName = '';
      this.userAge = null;
      this.referrer = 'wom';
      this.interest = [];
      this.how = null;
      this.confirm = false;
      this.rating = null;
    },
    validateInput() {
      if (this.userName === '') {
        this.userNameValidity = 'invalid';
      } else {
        this.userNameValidity = 'valid';

      }
    }
  },
}
</script>

<style scoped lang="sass">
form
  margin: 2rem auto
  max-width: 40rem
  border-radius: 12px
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26)
  padding: 2rem
  background-color: #ffffff

.form-control
  margin: 0.5rem 0

  &.invalid input
    border-color: red

  &.invalid label
    color: red

label
  font-weight: bold

h2
  font-size: 1rem
  margin: 0.5rem 0

input
  display: block
  width: 100%
  font: inherit
  margin-top: 0.5rem

select
  display: block
  width: 100%
  font: inherit
  margin-top: 0.5rem
  width: auto

input
  &[type='checkbox'], &[type='radio']
    display: inline-block
    width: auto
    margin-right: 1rem

  &[type='checkbox'] + label, &[type='radio'] + label
    font-weight: normal

button
  font: inherit
  border: 1px solid #0076bb
  background-color: #0076bb
  color: white
  cursor: pointer
  padding: 0.75rem 2rem
  border-radius: 30px

  &:hover, &:active
    border-color: #002350
    background-color: #002350
</style>