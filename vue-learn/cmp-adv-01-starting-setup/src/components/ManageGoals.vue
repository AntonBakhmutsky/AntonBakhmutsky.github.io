<template lang="pug">
div
  h2 Manage Goals
  input(type="text" ref="input")
  button(@click="setGoal") Set Goal
  teleport(to="body")
    ErrorAlert(v-if="inputIsInvalid")
      h2 Input is invalid!
      p Please enter at least a few characters...
      button(@click="confirmError") Okay
</template>

<script>
import ErrorAlert from './ErrorAlert';

export default {
  components: {
    ErrorAlert
  },
  data() {
    return {
      inputIsInvalid: false
    }
  },
  methods: {
    setGoal() {
      const enteredValue = this.$refs.input.value;
      if (enteredValue === '') {
        this.inputIsInvalid = true;
      }
    },
    confirmError() {
      this.inputIsInvalid = false;
    }
  }
}
</script>