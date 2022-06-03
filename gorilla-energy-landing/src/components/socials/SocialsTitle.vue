<template lang="pug">
  h2.socials__title.section-title.section-title_white.animated(v-lazyload)
    .section-title__link(v-lazyload)
    span(v-html="$t('socials.title')")
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'

export default {
  name: 'SocialsTitle',
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        anime({
          targets: this.$el,
          opacity: [0, 1],
          translateY: ['-100%', 0],
          duration: 300,
          easing: 'linear'
        })
      }, 'bottom')
    })
  }
}
</script>
