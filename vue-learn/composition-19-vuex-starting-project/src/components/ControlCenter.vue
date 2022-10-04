<template lang="pug">
button(@click="inc") Increment
</template>

<script>
export default {
  setup() {
    function inc() {}

    return { inc };
  },
};
</script>