<template lang="pug">
h2 {{ counter }}
</template>

<script>
export default {
  setup() {
    const counter = 0;

    return { counter };
  },
};
</script>