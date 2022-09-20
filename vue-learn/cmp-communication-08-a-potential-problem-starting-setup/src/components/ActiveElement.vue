<template lang="pug">
section
  h2 {{ topicTitle }}
  p {{ text }}
</template>

<script>
export default {
  props: ['topicTitle', 'text'],
};
</script>