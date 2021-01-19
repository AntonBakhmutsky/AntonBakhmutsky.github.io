<template lang="pug">
  .header__top.animated
    .header__mobile-menu-btn
    .header__mobile-overlay
    HeaderTopMobileMenu
    HeaderTopLanguage
    HeaderTopMenu
</template>

<script>
import HeaderTopLanguage from './HeaderTopLanguage'
import HeaderTopMenu from './HeaderTopMenu'
import HeaderTopMobileMenu from './HeaderTopMobileMenu'

export default {
  name: 'HeaderTop',
  components: {
    HeaderTopMobileMenu,
    HeaderTopMenu,
    HeaderTopLanguage
  }
}
</script>
