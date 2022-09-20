<template lang="pug">
ul
  knowledge-element(
    v-for="topic in topics"
    :key="topic.id"
    :id="topic.id"
    :topic-name="topic.title"
    :description="topic.description"
    @select-topic="$emit('select-topic', $event)"
  )
</template>

<script>
export default {
  props: ['topics'],
  emits: ['select-topic']
};
</script>