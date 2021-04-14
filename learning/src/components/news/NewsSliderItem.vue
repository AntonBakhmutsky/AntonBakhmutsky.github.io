<template lang="pug">
  .news-card.animated(
    v-lazyload
    :class="`news-card_${category.code}`"
    :data-back="item.preview_image"
    v-tap="showModal"
  )
    .news-card__details(v-lazyload)
      .news-card__type(
        v-lazyload
        :class="`news-card__type_${category.code}`"
      ) {{ category.name }}
      .news-card__content
        .news-card__header {{ item.name }}
        .news-card__text(v-html="item.preview_text")
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'NewsSliderItem',
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  computed: {
    category: vm => vm.item.category || {}
  },
  methods: {
    ...mapActions('news', ['show']),
    showModal () {
      if (this.item.external_link) {
        return window.open(this.item.external_link)
      }

      this.show(this.item.id)

      if (this.category.code === 'events') {
        this.$modal.show('NewsModalPoster')
      } else {
        this.$modal.show('NewsModal')
      }
    }
  }
}
</script>
