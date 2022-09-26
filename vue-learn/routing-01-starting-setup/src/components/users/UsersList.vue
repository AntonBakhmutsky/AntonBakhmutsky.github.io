<template lang="pug">
button(@click="confirmInput") Confirm
ul
  UserItem(v-for="user in users" :key="user.id" :name="user.fullName" :role="user.role")
</template>

<script>
import UserItem from './UserItem.vue';

export default {
  components: {
    UserItem,
  },
  inject: ['users'],
  methods: {
    confirmInput() {
      this.$router.push('/teams');
    }
  },
  beforeRouteEnter(to, from, next){
    console.log('Users Cmp beforeRuteEnter');
    console.log(to, from);
    next();
  }
};
</script>

<style lang="sass" scoped>
ul
  list-style: none
  margin: 2rem auto
  max-width: 20rem
  padding: 0
</style>