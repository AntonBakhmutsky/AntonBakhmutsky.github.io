<template lang="pug">

ul
  LearningResource(
    v-for="res in resources"
    :key="res.id"
    :title="res.title"
    :description="res.description"
    :link="res.link"
  )

</template>

<script>
import LearningResource from './LearningResource';

export default {
  components: {
    LearningResource
  },
  props: ['resources'],
}
</script>

<style lang="sass" scoped>
ul
  list-style: none
  margin: 0 auto
  padding: 0
  max-width: 40rem
</style>