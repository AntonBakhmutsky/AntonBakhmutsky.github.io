<template lang="pug">
BaseContainer(v-if='user')
  h2 {{ user.fullName }}: Projects
  BaseSearch(v-if='hasProjects' @search='updateSearch' :search-term='enteredSearchTerm')
  ul(v-if='hasProjects')
    ProjectItem(v-for='prj in availableProjects' :key='prj.id' :title='prj.title')
  h3(v-else='') No projects found.
BaseContainer(v-else='')
  h3 No user selected.
</template>

<script>
import ProjectItem from './ProjectItem.vue';

export default {
  components: {
    ProjectItem,
  },
  props: ['user'],
  data() {
    return {
      enteredSearchTerm: '',
      activeSearchTerm: '',
    };
  },
  computed: {
    hasProjects() {
      return this.user.projects && this.availableProjects.length > 0;
    },
    availableProjects() {
      if (this.activeSearchTerm) {
        return this.user.projects.filter((prj) =>
          prj.title.includes(this.activeSearchTerm)
        );
      }
      return this.user.projects;
    },
  },
  methods: {
    updateSearch(val) {
      this.enteredSearchTerm = val;
    },
  },
  watch: {
    enteredSearchTerm(val) {
      setTimeout(() => {
        if (val === this.enteredSearchTerm) {
          this.activeSearchTerm = val;
        }
      }, 300);
    },
    user() {
      this.enteredSearchTerm = '';
    },
  },
};
</script>

<style lang="sass" scoped>
ul
  list-style: none
  margin: 0
  padding: 0
</style>