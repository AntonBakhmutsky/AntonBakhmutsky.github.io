<template lang="pug">
  .map__selects.animated
    SelectFilter(
      :placeholder="$t('map.countries')"
      :options="countries"
      :value="country"
      @input="SET_COUNTRY"
    )
    SelectFilter(
      :placeholder="$t('map.cities')"
      :options="cities"
      :value="city"
      @input="SET_CITY"
    )
</template>

<script>
import { mapState, mapMutations, mapGetters } from 'vuex'
import SelectFilter from '@/components/forms/SelectFilter'
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'

export default {
  name: 'MapSelects',
  computed: {
    ...mapState('map', ['city', 'country']),
    ...mapGetters('map', ['countries', 'cities'])
  },
  components: {
    SelectFilter
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        anime({
          targets: this.$el,
          opacity: [0, 1],
          duration: 200,
          easing: 'linear'
        })
      }, 'bottom')
    })
  },
  methods: {
    ...mapMutations('map', ['SET_CITY', 'SET_COUNTRY'])
  }
}
</script>
