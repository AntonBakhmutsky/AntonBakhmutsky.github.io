<template lang="pug">
  .header__top.animated
    .header__mobile-menu-btn
    .header__mobile-overlay
    HeaderTopMobileMenu
    HeaderTopLanguage
    HeaderTopMenu
</template>

<script>
import HeaderTopMobileMenu from '@/components/header/HeaderTopMobileMenu'
import HeaderTopLanguage from '@/components/header/HeaderTopLanguage'
import HeaderTopMenu from '@/components/header/HeaderTopMenu'

export default {
  name: 'HeaderTop',
  components: {
    HeaderTopMenu,
    HeaderTopLanguage,
    HeaderTopMobileMenu
  }
}
</script>
