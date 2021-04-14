<template lang="pug">
  .header__title.animated
    .header__title-stroke-container
      .header__title-stroke.animated(ref="stroke")
    h1 {{ $t('header.title') }}
    p {{ $t('header.tagline') }}
</template>

<script>
import anime from 'animejs'

export default {
  name: 'HeaderTitle',
  mounted () {
    this.$nextTick(() => {
      anime.timeline()
        .add({
          targets: this.$el,
          opacity: [0, 1],
          scale: [0.2, 1],
          duration: 200,
          delay: 2200,
          easing: 'linear'
        })
        .add({
          targets: this.$refs.stroke,
          opacity: [1, 1],
          width: [0, '100%'],
          duration: 400,
          easing: 'linear'
        })
    })
  }
}
</script>
