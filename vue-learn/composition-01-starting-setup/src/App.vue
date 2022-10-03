<template lang="pug">
section.container
  h2 {{ userName }}
</template>

<script>
export default {
  data() {
    return {
      userName: 'Maximilian',
    };
  },
};
</script>

<style lang="sass">
*
  box-sizing: border-box

html
  font-family: sans-serif

body
  margin: 0

.container
  margin: 3rem auto
  max-width: 30rem
  border-radius: 12px
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26)
  padding: 1rem
  text-align: center
</style>