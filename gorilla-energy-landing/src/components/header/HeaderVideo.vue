<template lang="pug">
  .header__video(v-if="poster || mp4")
    video(
      :poster="poster"
      muted
      autoplay
      loop
      playsinline
    )
      source(
        :src="mp4"
        type="video/mp4"
      )
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'HeaderVideo',
  data: () => ({
    poster: null,
    mp4: null
  }),
  computed: {
    ...mapState('siteVersions', {
      currentCountry: state => state.item
    })
  },
  watch: {
    currentCountry () {
      this.poster = window.innerWidth > 1024
        ? require(`@/assets/video/header-${this.currentCountry?.code}.jpg`)
        : require(`@/assets/video/header-mobile-${this.currentCountry?.code}.jpg`)

      this.mp4 = window.innerWidth > 1024
        ? require(`@/assets/video/header-${this.currentCountry?.code}.mp4`)
        : require(`@/assets/video/header-mobile-${this.currentCountry?.code}.mp4`)
    }
  }
}
</script>
