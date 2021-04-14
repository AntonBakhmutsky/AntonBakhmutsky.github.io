<template lang="pug">
  a.header__collection.animated(href="#news" v-if="$t('header.collection')")
    .header__collection-text(v-html="$t('header.collection')")
</template>

<script>
import anime from 'animejs'

export default {
  name: 'HeaderCollection',
  mounted () {
    this.$nextTick(() => {
      anime({
        targets: this.$el,
        opacity: [0, 1],
        translateY: ['50%', 0],
        duration: 400,
        delay: 1800,
        easing: 'easeInOutQuad'
      })
    })
  }
}
</script>
