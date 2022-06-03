<template lang="pug">
  section.rappers#rappers(v-lazyload)
    .container
      RappersTitle
      template(v-if="items.length")
        RappersSlider
      template(v-else)
        RappersPreloader
</template>

<script>
import { mapState, mapActions } from 'vuex'

import inViewport from '@/helpers/inViewport'
import RappersTitle from '@/components/rappers/RappersTitle'
import RappersPreloader from '@/components/rappers/RappersPreloader'
import RappersSlider from '@/components/rappers/RappersSlider'

export default {
  name: 'Rappers',
  components: {
    RappersTitle,
    RappersPreloader,
    RappersSlider
  },
  computed: {
    ...mapState('rappers', ['items']),
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
    ...mapActions('rappers', ['fetch'])
  }
}
</script>
