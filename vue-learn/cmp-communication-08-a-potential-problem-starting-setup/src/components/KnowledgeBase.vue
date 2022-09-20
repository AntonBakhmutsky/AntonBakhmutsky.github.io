<template lang="pug">
section
  h2 Select a Topic
  knowledge-grid(:topics="topics" @select-topic="$emit('select-topic', $event)")
</template>

<script>
export default {
  props: ['topics'],
  emits: ['select-topic'],
};
</script>