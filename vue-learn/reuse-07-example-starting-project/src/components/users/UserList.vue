<template lang="pug">
BaseContainer
  h2 Active Users
  BaseSearch(@search='updateSearch' :search-term='enteredSearchTerm')
  div
    button(@click="sort('asc')" :class="{selected: sorting === 'asc'}") Sort Ascending
    button(@click="sort('desc')" :class="{selected: sorting === 'desc'}") Sort Descending
  ul
    UserItem(v-for='user in displayedUsers' :key='user.id' :user-name='user.fullName' :id='user.id' @list-projects="$emit('list-projects', $event)")
</template>

<script>
import { toRefs } from 'vue';
import useSearch from "@/hook/search";
import useSorting from "@/hook/sorting";
import UserItem from './UserItem.vue';

export default {
  components: {
    UserItem,
  },
  props: ['users'],
  emits: ['list-projects'],
  setup(props) {
    const { users } = toRefs(props);

    const {enteredSearchTerm, availableItems, updateSearch} = useSearch(users, 'fullName');

    const {displayedItems, sorting, sort} = useSorting(availableItems, 'fullName');

    return {
      enteredSearchTerm,
      updateSearch,
      displayedUsers: displayedItems,
      sorting,
      sort
    };
  },
};
</script>

<style scoped>
ul {
  list-style: none;
  margin: 0;
  padding: 0;
}
</style>