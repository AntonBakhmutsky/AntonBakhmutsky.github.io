<template lang="pug">
  .map-popup
    .map-popup__wrap(v-lazyload)
      .map-popup__close(v-lazyload ref="close")
      .map-popup__city {{ item.name }}
      .map-popup__country {{ country.name }}
      .map-popup__message(v-html="item.description")
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'MapPopup',
  computed: {
    ...mapState('map', ['item']),
    country: vm => vm.item.country || {}
  }
}
</script>
