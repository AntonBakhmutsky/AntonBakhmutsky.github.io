<template lang="pug">
  section.socials#socials(v-lazyload)
    .socials__bg
      .socials__bg-left-back(v-lazyload ref="left_back")
      .socials__bg-left-front(v-lazyload ref="left_front")
      .socials__bg-right(v-lazyload ref="right")
      .socials__bg-splatter-1(v-lazyload ref="splatter_1")
      .socials__bg-splatter-2(v-lazyload ref="splatter_2")
    .container
      SocialsTitle
      SocialsList(v-if="items.length")
      SocialsPreloader(v-else)
      SocialsLinks
</template>

<script>
import anime from 'animejs'
import { mapState, mapActions } from 'vuex'

import SocialsTitle from '@/components/socials/SocialsTitle'
import SocialsList from '@/components/socials/SocialsList'
import SocialsLinks from '@/components/socials/SocialsLinks'
import SocialsPreloader from '@/components/socials/SocialsPreloader'
import inViewport from '@/helpers/inViewport'

export default {
  name: 'Socials',
  components: {
    SocialsPreloader,
    SocialsLinks,
    SocialsList,
    SocialsTitle
  },
  computed: {
    ...mapState('socials', ['items']),
    ...mapState('siteVersions', {
      currentCountry: state => state.item
    })
  },
  watch: {
    currentCountry () {
      this.$nextTick(() => {
        inViewport(this.$el, this.fetch, 'offset')

        anime({
          targets: this.$refs.left_back,
          keyframes: [
            { translateX: -20, translateY: -10 },
            { translateX: 0, translateY: -5 },
            { translateX: 25, translateY: 0 },
            { translateX: 0, translateY: 0 }
          ],
          duration: 5000,
          easing: 'linear',
          loop: true
        })

        anime({
          targets: this.$refs.right,
          keyframes: [
            { translateX: 20, translateY: 5 },
            { translateX: 10, translateY: 10 },
            { translateX: -5, translateY: 0 },
            { translateX: 0, translateY: 0 }
          ],
          duration: 5000,
          easing: 'linear',
          loop: true
        })

        anime({
          targets: this.$refs.splatter_1,
          keyframes: [
            { translateX: -10, translateY: -20 },
            { translateX: 0, translateY: -5 },
            { translateX: 5, translateY: 25 },
            { translateX: 0, translateY: 0 }
          ],
          duration: 5000,
          easing: 'linear',
          loop: true
        })

        anime({
          targets: this.$refs.splatter_2,
          keyframes: [
            { translateX: 5, translateY: 20 },
            { translateX: 10, translateY: 10 },
            { translateX: 0, translateY: -5 },
            { translateX: 0, translateY: 0 }
          ],
          duration: 5000,
          easing: 'linear',
          loop: true
        })
      })
    }
  },
  methods: {
    ...mapActions('socials', ['fetch'])
  }
}
</script>
