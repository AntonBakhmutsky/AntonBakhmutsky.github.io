<template lang="pug">
UserAlert(v-if='alertIsVisible' title='Add a User?' @close='hideAlert')
  p Do you want to continue with adding a user?
section
  h2 Add a User
  button(@click='showAlert') Add User
</template>

<script>
import alertMixin from '../mixins/alert';
import UserAlert from "@/components/UserAlert";

export default {
  components: {
    UserAlert,
  },
  mixins: [alertMixin]
};
</script>