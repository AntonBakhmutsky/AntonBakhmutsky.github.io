<template lang="pug">
  section.news#news(v-lazyload)
    .news__bg-color
    .news__overlay(v-lazyload)
    .news__bottom(ref="bottom")
      .news__bottom-left(v-lazyload)
      .news__bottom-right(v-lazyload)
    .container
      NewsTitle
      NewsFilter(v-if="categories.length")
      NewsSlider(v-if="items.length")
    NewsPreloader(v-if="!items.length")
</template>

<script>
import inViewport from '@/helpers/inViewport'
import { mapActions, mapState } from 'vuex'
import Rellax from 'rellax'

import NewsTitle from '@/components/news/NewsTitle'
import NewsFilter from '@/components/news/NewsFilter'
import NewsPreloader from '@/components/news/NewsPreloader'
import NewsSlider from '@/components/news/NewsSlider'

export default {
  name: 'News',
  components: {
    NewsSlider,
    NewsPreloader,
    NewsFilter,
    NewsTitle
  },
  computed: {
    ...mapState('news', ['items', 'categories'])
  },
  mounted () {
    inViewport(this.$el, () => {
      this.fetchCategories()
      this.fetch()
    }, 'offset')

    new Rellax(this.$refs.bottom, {
      center: true,
      speed: 3
    })
  },
  methods: {
    ...mapActions('news', ['fetch', 'fetchCategories'])
  }
}
</script>
