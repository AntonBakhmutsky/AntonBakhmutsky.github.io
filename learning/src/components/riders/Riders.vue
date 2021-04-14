<template lang="pug">
  section.riders#riders(v-lazyload)
    .riders__bottom-text(ref="text" v-lazyload)
    .container
      .riders__jump-1(ref="jump_1" v-lazyload)
      .riders__jump-2(ref="jump_2" v-lazyload)
      RidersTitle
      template(v-if="items.length")
        RidersFilter
        RidersSlider
      template(v-else)
        RidersPreloader
      RidersBecome
</template>

<script>
import Rellax from 'rellax'
import { mapState, mapActions } from 'vuex'
import inViewport from '@/helpers/inViewport'

import RidersTitle from '@/components/riders/RidersTitle'
import RidersFilter from '@/components/riders/RidersFilter'
import RidersBecome from '@/components/riders/RidersBecome'
import RidersSlider from '@/components/riders/RidersSlider'
import RidersPreloader from '@/components/riders/RidersPreloader'
import RidersModal from '@/components/riders/RidersModal'

export default {
  name: 'Riders',
  components: {
    RidersModal,
    RidersPreloader,
    RidersSlider,
    RidersBecome,
    RidersFilter,
    RidersTitle
  },
  computed: {
    ...mapState('riders', ['items'])
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, this.fetch, 'offset')

      new Rellax(this.$refs.text, {
        center: true,
        speed: 5
      })

      new Rellax(this.$refs.jump_1, {
        center: true,
        speed: 5
      })

      new Rellax(this.$refs.jump_2, {
        center: true,
        speed: 5
      })
    })
  },
  methods: {
    ...mapActions('riders', ['fetch'])
  }
}
</script>
