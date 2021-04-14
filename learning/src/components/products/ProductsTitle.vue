<template lang="pug">
  h2.products__title.section-title.section-title_white.lazyload.animated
    a.section-title__link.lazyload
    span Products
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'

export default {
  name: 'ProductsTitle',
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        anime({
          targets: this.$el,
          opacity: [0, 1],
          translateY: ['-100%', 0],
          duration: 200,
          easing: 'linear'
        })
      }, 'bottom')
    })
  }
}
</script>
