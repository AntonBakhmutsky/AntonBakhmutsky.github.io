<script setup>

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

const title = computed(() => `${lesson.value.title} - ${course.title}`)

useHead({
  title: `${title.value}`
})

const progress = useLocalStorage('progress', [])

const isLessonComplete = computed(() => {
  if (!progress.value[chapter.value.number - 1]) {
    return false
  }

  if (!progress.value[chapter.value.number - 1][lesson.value.number - 1]) {
    return false
  }

  return progress.value[chapter.value.number - 1][lesson.value.number - 1]
})

const toggleComplete = () => {
  if (!progress.value[chapter.value.number - 1]) {
    progress.value[chapter.value.number - 1] = []
  }

  progress.value[chapter.value.number - 1][lesson.value.number - 1] = !isLessonComplete.value
}
</script>

<template>
  <h2 class="sec-title">Lesson {{ chapter.number }} - {{ lesson.number }}</h2>
  <h2 class="less-title">{{ lesson.title }}</h2>
  <div>
    <NuxtLink
        v-if="lesson.sourceUrl"
        :to="lesson.sourceUrl"
    >
      Download Source Code
    </NuxtLink>
    <NuxtLink
        class="video-link"
        v-if="lesson.downloadUrl"
        :to="lesson.downloadUrl"
    >
      Download Video
    </NuxtLink>
  </div>
  <VideoPLaer
      v-if="lesson.videoId"
      :video-id="lesson.videoId.toString()"
  />
  <p>{{ lesson.text }}</p>
  <LessonCompleteButton
      :model-value="isLessonComplete"
      @update:model-value="toggleComplete"
  />
</template>