<template lang="pug">
UserAlert(v-if='alertIsVisible' title='Delete User?' @close='hideAlert')
  p Do you want to continue with deleting a user?
section
  h2 Delete a User
  button(@click='showAlert') Delete User
</template>

<script>
import { ref } from 'vue';
import UserAlert from './UserAlert.vue';

export default {
  components: {
    UserAlert,
  },
  setup() {
    const alertIsVisible = ref(false);

    function showAlert() {
      alertIsVisible.value = true;
    }
    function hideAlert() {
      alertIsVisible.value = false;
    }

    return {
      alertIsVisible,
      showAlert,
      hideAlert,
    };
  },
};
</script>