<template lang="pug">
  .products__slider
    .products__slider-arrow.products__slider-arrow_left(v-lazyload)
    .products__slider-arrow.products__slider-arrow_right(v-lazyload)
    .products__slider-content
      .products__slider-item(
        v-for="item in items"
        :key="item.code"
        :class="`products__slider-item_${item.code}`"
        v-tap="() => showModal(item)"
      )
        .products__slider-item-name {{ item.name }}
        .products__slider-item-image(v-lazyload)
        .products__slider-item-more(v-lazyload) {{ $t('products.more') }}
</template>

<script>
import { mapState, mapMutations } from 'vuex'

import Swiper, { Navigation } from 'swiper'

Swiper.use([Navigation])

export default {
  name: 'ProductsSlider',
  computed: {
    ...mapState('products', ['items'])
  },
  mounted () {
    this.$nextTick(() => {
      new Swiper('.products__slider', {
        speed: 800,
        spaceBetween: 80,
        wrapperClass: 'products__slider-content',
        slideClass: 'products__slider-item',
        slideActiveClass: 'products__slider-item_active',
        navigation: {
          nextEl: '.products__slider-arrow_right',
          prevEl: '.products__slider-arrow_left',
          disabledClass: 'products__slider-arrow_disabled'
        }
      })
    })
  },
  methods: {
    ...mapMutations('products', ['SET_ITEM']),
    showModal (item) {
      this.SET_ITEM(item)
      this.$modal.show('ProductsModal')
    }
  }
}
</script>
