<template lang="pug">
  .news__filter.animated
    .news__filter-desktop
      .news__filter-item.news__filter-item_all(
        :class="{'news__filter-item_active': !category.code }"
        v-tap="() => SET_CATEGORY(null)"
        v-lazyload
      ) {{ $t('news.placeholder') }}
      template(v-for="item in categories")
        .news__filter-delimiter(v-lazyload)
        .news__filter-item(
          :key="item.code"
          :class="{'news__filter-item_active': item.code === category.code }"
          v-tap="() => SET_CATEGORY(item)"
          v-lazyload
        ) {{ item.name }}
    .news__filter-mobile
      SelectFilter(
        :placeholder="$t('news.placeholder')"
        :options="categories"
        :value="category"
        @input="SET_CATEGORY"
      )
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'
import { mapMutations, mapState, mapActions } from 'vuex'
import SelectFilter from '@/components/forms/SelectFilter'

export default {
  name: 'NewsFilter',
  components: { SelectFilter },
  computed: {
    ...mapState('news', ['category', 'categories'])
  },
  watch: {
    async category () {
      await this.fetch()
    }
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        anime({
          targets: this.$el,
          opacity: [0, 1],
          duration: 200,
          easing: 'linear'
        })
      }, 'bottom')
    })
  },
  methods: {
    ...mapMutations('news', ['SET_CATEGORY']),
    ...mapActions('news', ['fetch'])
  }
}
</script>
