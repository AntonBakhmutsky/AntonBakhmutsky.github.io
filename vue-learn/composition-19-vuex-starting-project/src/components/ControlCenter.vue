<template lang="pug">
button(@click="inc") Increment
</template>

<script>
import { useStore } from 'vuex';
export default {
  setup() {
    const store = useStore();

    function inc() {
      store.dispatch('increment');
    }

    return { inc };
  },
};
</script>