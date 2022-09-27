<template lang="pug">
button(@click="logIn" v-if="!userIsAuthenticated") Login
button(@click="logOut" v-if="userIsAuthenticated") Logout
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
  methods: {
    ...mapActions(['logIn', 'logOut'])
  },
  computed: {
    ...mapGetters(['userIsAuthenticated'])
  }
}
</script>