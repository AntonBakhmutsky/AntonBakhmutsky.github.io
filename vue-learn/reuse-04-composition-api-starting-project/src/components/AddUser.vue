<template lang="pug">
UserAlert(v-if='alertIsVisible' title='Add a User?' @close='hideAlert')
  p Do you want to continue with adding a user?
section
  h2 Add a User
  button(@click='showAlert') Add User
</template>

<script>
import UserAlert from './UserAlert.vue';
import useAlert from '@/hooks/alert';

export default {
  components: {
    UserAlert,
  },
  setup() {
    const [alertIsVisible, showAlert, hideAlert] = useAlert();
    return {alertIsVisible, showAlert, hideAlert};
  },
};
</script>