<template lang="pug">
  ModalLayout(
    type="rapper"
    :active="active"
    @hide="hide"
  )
    .modal__content(v-if="item.id")
      .modal__top
        h2.modal__mobile-header
          .modal__mobile-header-link
          | {{ item.name }}
        .modal__photo(:style="{ 'background-image': `url(${photo})` }")
        .modal__about
          h2.modal__about-header {{ item.name }}
            span(v-if="item.nickname") «{{ item.nickname }}»
          .modal__about-item(v-if="item.birthdate")
            .modal__about-title {{ $t('rappers.born') }}
            .modal__about-text {{ item.birthdate | date }}
          .modal__about-item(v-if="item.birthplace")
            .modal__about-title {{ $t('rappers.city') }}
            .modal__about-text {{ item.birthplace }}
          .modal__about-item(v-if="item.style")
            .modal__about-title {{ $t('rappers.style') }}
            .modal__about-text {{ item.style }}
        .modal__socials
          .colored__socials
            a.colored__socials-item(
              v-lazyload
              v-for="(value, code) in item.socials"
              v-if="value"
              :class="`colored__socials-item_${code}`"
              :href="value"
              target="_blank"
              rel="noopener noreferrer"
            )
      ModalSlider(:items="item.media_blocks")
      .modal__info(v-if="item.description" v-html="item.description")
    ModalPreloader(v-else)
</template>

<script>
import modals from '@/mixins/modals'
import { mapState } from 'vuex'
import ModalSlider from '@/components/modals/ModalSlider'
import ModalPreloader from '@/components/modals/ModalPreloader'

export default {
  name: 'RappersModal',
  components: { ModalPreloader, ModalSlider },
  mixins: [modals],
  computed: {
    ...mapState('rappers', ['item']),
    photo: vm => vm.item.image ? vm.item.image : require('@/assets/img/riders/riders_stub.png')
  }
}
</script>
