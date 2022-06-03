<template lang="pug">
  .human-card.animated(v-tap="showModal")
    .human-card__image
      img(v-lazyload :data-src="alt_photo" alt="")
    .human-card__image-hover
      img(v-lazyload :data-src="photo" alt="")
    .human-card__info
      .human-card__info-shadow
      .human-card__info-name(v-lazyload)
        span(v-html="displayName")
      .human-card__info-discipline(
        v-lazyload
        v-if="item.category"
      ) {{ item.category.name }}
      .human-card__info-more.more-btn(v-lazyload) {{ $t('fighters.more') }}
</template>

<script>
import { mapActions } from 'vuex'

export default {
  name: 'FightersSliderItem',
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  computed: {
    displayName: vm => vm.item.name?.split(' ')?.join('<br>'),
    photo: vm => vm.item.image ? vm.item.image : require('@/assets/img/riders/riders_stub.png'),
    alt_photo: vm => vm.item.alt_image ? vm.item.alt_image : require('@/assets/img/riders/riders_stub.png')
  },
  methods: {
    ...mapActions('fighters', ['show']),
    showModal () {
      this.show(this.item.id)
      this.$modal.show('FightersModal')
    }
  }
}
</script>
