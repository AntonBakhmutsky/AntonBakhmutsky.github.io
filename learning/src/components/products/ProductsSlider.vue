<template lang="pug">
  .products__slider
    .products__slider-arrow.products__slider-arrow_left.lazyload
    .products__slider-arrow.products__slider-arrow_right.lazyload
    .products__slider-content
      .products__slider-item(
        v-for="item in items"
        :key="item.code"
        :class="[ `products__slider-item_${item.code}` ]"
      )
        a.products__slider-item-name(
          href="javascript:"
        ) {{ item.name }}
        a.products__slider-item-image.lazyload(
          href="javascript:"
        )
        a.products__slider-item-more.lazyload(
          href="javascript:"
        ) Read More
</template>

<script>
import Swiper, { Navigation } from 'swiper'
Swiper.use([Navigation])

export default {
  name: 'ProductsSlider',
  data: () => ({
    items: [
      { name: 'original', code: 'original' },
      { name: 'orange', code: 'orange' },
      { name: 'ice', code: 'ice' },
      { name: 'pomegranate', code: 'pomegranate' },
      { name: 'california', code: 'california' }
    ]
  }),
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
  }
}
</script>
