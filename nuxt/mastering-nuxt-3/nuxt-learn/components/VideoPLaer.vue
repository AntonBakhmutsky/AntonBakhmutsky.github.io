<script lang="ts" setup>
const props = defineProps({
  videoId: {
    type: String,
    required: true
  }
})

</script>

<template>
  <iframe
    width="560"
    height="315"
    :src="`https://player.vimeo.com/video/${props.videoId}`"
    title="Video player"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-white; encrypted-media;"
    allowfullscreen
  >
  </iframe>
</template>

<style scoped></style>
