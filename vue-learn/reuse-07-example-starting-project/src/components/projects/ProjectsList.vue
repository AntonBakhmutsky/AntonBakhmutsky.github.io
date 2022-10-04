<template lang="pug">
BaseContainer(v-if='user')
  h2 {{ user.fullName }}: Projects
  BaseSearch(v-if='hasProjects' @search='updateSearch' :search-term='enteredSearchTerm')
  ul(v-if='hasProjects')
    ProjectItem(v-for='prj in availableItems' :key='prj.id' :title='prj.title')
  h3(v-else='') No projects found.
BaseContainer(v-else='')
  h3 No user selected.
</template>

<script>
import { computed, watch, toRefs } from 'vue';
import useSearch from "@/hook/search";
import ProjectItem from './ProjectItem.vue';

export default {
  components: {
    ProjectItem,
  },
  props: ['user'],
  setup(props) {
    const { user } = toRefs(props);

    const projects = computed(function () {
      return user.value ? user.value.projects : [];
    });

    const {enteredSearchTerm, availableItems, updateSearch} = useSearch(projects, 'title');

    const hasProjects = computed(function () {
      return props.user.projects && availableItems.value.length > 0;
    });

    watch(user, function () {
      enteredSearchTerm.value = '';
    });

    return {
      enteredSearchTerm,
      availableItems,
      hasProjects,
      updateSearch,
    };
  },
};
</script>

<style lang="sass" scoped>
ul
  list-style: none
  margin: 0
  padding: 0
</style>