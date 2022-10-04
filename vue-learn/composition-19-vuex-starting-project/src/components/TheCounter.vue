<template lang="pug">
h2 {{ counter }}
</template>

<script>
import { computed } from "vue";
import { useStore } from 'vuex';
export default {
  setup() {
    const store = useStore();
    const counter = computed(function() {
      return store.getters.counter;
    });

    return { counter };
  },
};
</script>