<template lang="pug">

div
  TheHeader
  button(@click="setSelectedComponents('active-goals')") Active Goals
  button(@click="setSelectedComponents('manage-goals')") Manage Goals
  //ActiveGoals(v-if="selectedComponent === 'active-goals'")
  //ManageGoals(v-if="selectedComponent === 'manage-goals'")
  keep-alive
    component(:is="selectedComponent")


</template>

<script>
import TheHeader from './components/TheHeader.vue';
// import BadgeList from './components/BadgeList.vue';
// import CourseGoals from './components/CourseGoals';
// import UserInfo from './components/UserInfo';
import ActiveGoals from './components/ActiveGoals';
import ManageGoals from './components/ManageGoals';

export default {
  components: {
    TheHeader,
    ActiveGoals,
    ManageGoals
  },
  data() {
    return {
      selectedComponent: 'active-goals',
      activeUser: {
        name: 'Maximilian Schwarzmüller',
        description: 'Site owner and admin',
        role: 'admin',
      },
    };
  },
  methods: {
    setSelectedComponents(cmp) {
      this.selectedComponent = cmp;
    }
  }
};
</script>

<style>
html {
  font-family: sans-serif;
}

body {
  margin: 0;
}
</style>