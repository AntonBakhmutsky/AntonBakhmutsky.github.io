<template lang="pug">
  section.fighters#fighters(v-lazyload)
    .container
      FightersTitle
      template(v-if="items.length")
        FightersPromo
        FightersSlider
      template(v-else)
        FightersPreloader
</template>

<script>
import { mapState, mapActions } from 'vuex'

import FightersTitle from '@/components/fighters/FightersTitle'
import FightersPromo from '@/components/fighters/FightersPromo'
import FightersPreloader from '@/components/fighters/FightersPreloader'
import inViewport from '@/helpers/inViewport'
import FightersSlider from '@/components/fighters/FightersSlider'

export default {
  name: 'Fighters',
  components: {
    FightersSlider,
    FightersPreloader,
    FightersPromo,
    FightersTitle
  },
  computed: {
    ...mapState('fighters', ['items']),
    ...mapState('siteVersions', {
      currentCountry: state => state.item
    })
  },
  watch: {
    currentCountry () {
      this.$nextTick(() => {
        inViewport(this.$el, this.fetch, 'offset')
      })
    }
  },
  methods: {
    ...mapActions('fighters', ['fetch'])
  }
}
</script>
