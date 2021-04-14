<template lang="pug">
  .header__top.animated(:class="classList")
    HeaderTopMobileMenu
    HeaderTopLanguage
    HeaderTopMenu
</template>

<script>
import anime from 'animejs'

import HeaderTopLanguage from './HeaderTopLanguage'
import HeaderTopMenu from './HeaderTopMenu'
import HeaderTopMobileMenu from './HeaderTopMobileMenu'

export default {
  name: 'HeaderTop',
  components: {
    HeaderTopMobileMenu,
    HeaderTopMenu,
    HeaderTopLanguage
  },
  computed: {
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
