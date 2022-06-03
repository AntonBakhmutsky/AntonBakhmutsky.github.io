<template lang="pug">
  .header__top.animated(:class="classList")
    .header__top-country-txt {{ $t('country.txt') }}
    HeaderTopMobileMenu
    template(v-if="currentCountry.code !== 'ua'")
      HeaderTopCountries
      HeaderTopLanguage
    HeaderTopMenu
</template>

<script>
import anime from 'animejs'

import HeaderTopLanguage from './HeaderTopLanguage'
import HeaderTopCountries from './HeaderTopCountries'
import HeaderTopMenu from './HeaderTopMenu'
import HeaderTopMobileMenu from './HeaderTopMobileMenu'
import { mapState } from 'vuex'

export default {
  name: 'HeaderTop',
  components: {
    HeaderTopMobileMenu,
    HeaderTopMenu,
    HeaderTopCountries,
    HeaderTopLanguage
  },
  computed: {
    ...mapState('siteVersions', {
      currentCountry: state => state.item
    }),
    classList: vm => ({
      'header__top_black': ['fighter'].includes(vm.$route.name)
    })
  },
  mounted () {
    this.$nextTick(() => {
      anime({
        targets: this.$el,
        opacity: [0, 1],
        top: [-220, 0],
        duration: 800,
        easing: 'easeInOutQuad'
      })
    })
  }
}
</script>
