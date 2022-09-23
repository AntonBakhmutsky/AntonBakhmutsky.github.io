<template lang="pug">
form
  .form-control
    label(for='user-name') Your Name
    input#user-name(name='user-name' type='text')
  .form-control
    label(for='age') Your Age (Years)
    input#age(name='age' type='number')
  .form-control
    label(for='referrer') How did you hear about us?
    select#referrer(name='referrer')
      option(value='google') Google
      option(value='wom') Word of mouth
      option(value='newspaper') Newspaper
  .form-control
    h2 What are you interested in?
    div
      input#interest-news(name='interest' type='checkbox')
      label(for='interest-news') News
    div
      input#interest-tutorials(name='interest' type='checkbox')
      label(for='interest-tutorials') Tutorials
    div
      input#interest-nothing(name='interest' type='checkbox')
      label(for='interest-nothing') Nothing
  .form-control
    h2 How do you learn?
    div
      input#how-video(name='how' type='radio')
      label(for='how-video') Video Courses
    div
      input#how-blogs(name='how' type='radio')
      label(for='how-blogs') Blogs
    div
      input#how-other(name='how' type='radio')
      label(for='how-other') Other
  div
    button Save Data
</template>

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