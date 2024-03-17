<script setup>
const {chapters} = useCourse()
console.log(useCourse())
</script>

<template>
  <div class="app-header">
    <h1>Course: <span>Mastering Nuxt</span></h1>
  </div>
  <div class="app-container">
    <div class="app-container__left">
      <h3 class="fir-title">Chapters</h3>
      <div class="chapters">
        <div
            class="chapters__item"
            v-for="chapter in chapters"
            :key="chapter.slug"
        >
          <h4>{{ chapter.title }}</h4>
          <NuxtLink
              v-for="(lesson, index) in chapter.lessons"
              :key="lesson.slug"
              :to="lesson.path"
              class="lesson-link"
          >
            <span>{{ index + 1 }}.</span>
            <span>{{ lesson.title }}</span>
          </NuxtLink>
        </div>
      </div>
    </div>
    <div class="app-container__right">
      <NuxtPage/>
    </div>
  </div>
</template>

<style lang="sass" scoped>
    .router-link-active
      color: red
</style>