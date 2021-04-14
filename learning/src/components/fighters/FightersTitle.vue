<template lang="pug">
  h2.fighters__title.section-title.section-title_black.animated(v-lazyload)
    .section-title__link(v-lazyload)
    span {{ $t('fighters.title') }}
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'

export default {
  name: 'FightersTitle',
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
