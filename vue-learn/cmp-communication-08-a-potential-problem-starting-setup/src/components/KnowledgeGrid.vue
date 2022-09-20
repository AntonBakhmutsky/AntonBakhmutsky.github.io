<template lang="pug">
ul
  knowledge-element(
    v-for="topic in topics"
    :key="topic.id"
    :id="topic.id"
    :topic-name="topic.title"
    :description="topic.description"
  )
</template>

<script>
export default {
  inject: ['topics']
};
</script>