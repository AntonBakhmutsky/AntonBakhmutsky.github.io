<template lang="pug">
li
  h3 {{ topicName }}
  p {{ description }}
  button(@click="$emit('select-topic', id)") Learn More
</template>

<script>
export default {
  props: ['id', 'topicName', 'description'],
  emits: ['select-topic'],
};
</script>