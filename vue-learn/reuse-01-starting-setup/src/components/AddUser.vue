<template lang="pug">
UserAlert(v-if='alertIsVisible' title='Add a User?' @close='hideAlert')
  p Do you want to continue with adding a user?
section
  h2 Add a User
  button(@click='showAlert') Add User
</template>

<script>
import UserAlert from './UserAlert.vue';

export default {
  components: {
    UserAlert,
  },
  data() {
    return {
      alertIsVisible: false,
    };
  },
  methods: {
    showAlert() {
      this.alertIsVisible = true;
    },
    hideAlert() {
      this.alertIsVisible = false;
    },
  },
};
</script>