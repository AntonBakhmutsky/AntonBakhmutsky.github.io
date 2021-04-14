<template lang="pug">
  .socials__links
    a.socials__links-item.animated(
      v-lazyload
      ref="items"
      v-for="(item, index) in socials"
      :key="index"
      :class="`socials__links-item_${item.code}`"
      :href="item.href"
      target="_blank"
      rel="noopener noreferrer"
    )
      .socials__links-item-text(v-html="item.text")
      .socials__links-item-counter(v-if="item.counter") {{ item.counter }}
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'
import { mapState } from 'vuex'

export default {
  name: 'SocialsLinks',
  computed: {
    ...mapState('main', ['socials'])
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        anime({
          targets: this.$refs.items,
          opacity: [0, 1],
          duration: 400,
          delay: anime.stagger(200),
          easing: 'linear'
        })
      }, 'half')
    })
  }
}
</script>
