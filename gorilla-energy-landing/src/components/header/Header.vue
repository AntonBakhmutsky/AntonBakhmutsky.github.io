<template lang="pug">
  header.header.rellax#header
    HeaderVideo
    .container
      HeaderTitle
      HeaderSocials
      HeaderCollection(v-show="showCollection")
</template>

<script>
import Rellax from 'rellax'

import HeaderSocials from './HeaderSocials'
import HeaderTitle from './HeaderTitle'
import HeaderCollection from './HeaderCollection'
import HeaderVideo from './HeaderVideo'

export default {
  name: 'Header',
  components: {
    HeaderVideo,
    HeaderCollection,
    HeaderTitle,
    HeaderSocials
  },
  mounted () {
    this.$nextTick(() => {
      new Rellax(this.$el, {
        speed: -5
      })
    })
  },
  computed: {
    showCollection: vm => vm.$i18n.locale !== 'by' && vm.$i18n.locale !== 'ua'
  }
}
</script>
