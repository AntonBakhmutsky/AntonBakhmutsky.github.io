<template lang="pug">
UserAlert(v-if='alertIsVisible' :title='alertTitle' @close='hideAlert')
  p Do you want to continue with deleting a user?
section
  h2 Delete a User
  button(@click='showAlert') Delete User
</template>

<script>
import alertMixin from '../mixins/alert';
import UserAlert from "@/components/UserAlert";

export default {
  components: {
    UserAlert,
  },
  data() {
    return {
      alertTitle: 'Delete user?'
    }
  },
  mixins: [alertMixin]
};
</script>