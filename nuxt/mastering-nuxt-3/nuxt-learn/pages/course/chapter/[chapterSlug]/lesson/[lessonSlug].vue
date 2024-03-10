<script setup>

import VideoPLaer from "../../../../../components/VideoPLaer.vue";

const course = useCourse()
const route = useRoute()

const chapter = computed(() => {
  return course.chapters.find(
      (chapter) => chapter.slug === route.params.chapterSlug
  )
})

const lesson = computed(() => {
  return chapter.value.lessons.find(
      (lesson) => lesson.slug === route.params.lessonSlug
  )
})

</script>

<template>
  <h2 class="sec-title">Lesson {{ chapter.number }} - {{ lesson.number }}</h2>
  <h2 class="less-title">{{lesson.title}}</h2>
  <div>
    <a
        v-if="lesson.sourceUrl"
        :href="lesson.sourceUrl"
    >
      Download Source Code
    </a>
    <a
        class="video-link"
        v-if="lesson.downloadUrl"
        :href="lesson.downloadUrl"
    >
      Download Video
    </a>
  </div>
  <VideoPLaer
    v-if="lesson.videoId"
    :video-id="lesson.videoId.toString()"
  />
  <p>{{lesson.text}}</p>
</template>