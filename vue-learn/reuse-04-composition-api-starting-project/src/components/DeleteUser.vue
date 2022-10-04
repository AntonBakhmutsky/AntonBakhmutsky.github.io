<template lang="pug">
UserAlert(v-if='alertIsVisible' title='Delete User?' @close='hideAlert')
  p Do you want to continue with deleting a user?
section
  h2 Delete a User
  button(@click='showAlert') Delete User
</template>

<script>
import UserAlert from './UserAlert.vue';
import useAlert from '@/hooks/alert';

export default {
  components: {
    UserAlert,
  },
  setup() {
    const [alertIsVisible, showAlert, hideAlert] = useAlert(true);
    return {alertIsVisible, showAlert, hideAlert};
  }
};
</script>