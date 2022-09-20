<template lang="pug">
li
  h3 {{ topicName }}
  p {{ description }}
  button(@click="selectTopic(id)") Learn More
</template>

<script>
export default {
  inject: ['selectTopic'],
  props: ['id', 'topicName', 'description'],
  emits: ['select-topic'],
};
</script>