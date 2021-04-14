<template lang="pug">
  .socials__list
    SocialsListItem(
      ref="items"
      v-for="(item, index) in items"
      :key="index"
      :item="item"
    )
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'
import { mapState } from 'vuex'
import SocialsListItem from '@/components/socials/SocialsListItem'

export default {
  name: 'SocialsList',
  components: {
    SocialsListItem
  },
  computed: {
    ...mapState('socials', ['items'])
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        this.$refs.items.forEach((item, index) => {
          const x = index === 0 ? '-100%' : '100%'
          const delay = 200 * ((index - 1) % 4)

          anime({
            targets: item.$el,
            opacity: [0, 1],
            translateX: [x, 0],
            duration: 400,
            delay: delay,
            easing: 'linear'
          })
        })
      }, 'half')
    })
  }
}
</script>
