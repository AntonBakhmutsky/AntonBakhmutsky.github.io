<template lang="pug">
  h2.rappers__title.section-title.section-title_black.lazyload.animated(v-lazyload)
    .section-title__link.lazyload(v-lazyload)
    span {{ $t('rappers.title') }}
</template>

<script>
import inViewport from '../../helpers/inViewport'
import anime from 'animejs'

export default {
  name: 'RappersTitle',
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
