<template lang="pug">
  div
    .products__choose.animated(ref="choose")
      | Choose
      br
      | your energy
    .products__list(ref="list")
      .products__list-item-wrapper.animated(
        ref="wrapper"
        v-for="item in items"
        :key="item.code"
      )
        a.products__list-item.lazyload(
          :class="`products__list-item_${item.code}`"
          href="javascript:"
        ) {{ item.name }}
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'

export default {
  name: 'ProductsList',
  data: () => ({
    items: [
      { name: 'original', code: 'original', active: true },
      { name: 'orange', code: 'orange' },
      { name: 'ice', code: 'ice' },
      { name: 'pomegranate', code: 'pomegranate' },
      { name: 'california', code: 'california' }
    ]
  }),
  mounted () {
    inViewport(this.$refs.list, () => {
      anime.timeline()
        .add({
          targets: this.$refs.wrapper,
          opacity: [0, 1],
          scale: [2, 1],
          translateY: ['50%', 0],
          duration: 400,
          delay: anime.stagger(200),
          easing: 'easeOutQuad'
        })
        .add({
          targets: this.$refs.choose,
          opacity: [0, 1],
          translateX: ['-50%', 0],
          duration: 200,
          easing: 'easeOutQuad'
        })
    }, 'bottom')
  }
}
</script>
