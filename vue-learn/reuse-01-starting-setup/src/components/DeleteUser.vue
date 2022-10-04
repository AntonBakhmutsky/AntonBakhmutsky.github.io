<template lang="pug">
UserAlert(v-if='alertIsVisible' title='Delete the User?' @close='hideAlert')
  p Do you want to continue with deleting a user?
section
  h2 Delete a User
  button(@click='showAlert') Delete User
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