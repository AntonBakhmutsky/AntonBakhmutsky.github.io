<template lang="pug">
  main.main
    section.fighter
      .container
        .modal__content
          .modal__top
            h2.modal__mobile-header
              .modal__mobile-header-link
              | {{ item.name }}
            .modal__photo(:style="{ 'background-image': `url(${photo})` }")
            .modal__about
              h2.modal__about-header {{ item.name }}
                span(v-if="item.nickname") «{{ item.nickname }}»
              .modal__about-item(v-if="item.category")
                .modal__about-title {{ item.category.name }}
              .modal__about-stats
                .modal__about-stats-item(v-if="item.height")
                  .modal__about-stats-item-icon
                    img(src="@/assets/img/modals/fighter-height-icon.png" alt="")
                  .modal__about-stats-item-text {{ item.height }} {{ $t('fighters.cm') }}
                .modal__about-stats-item(v-if="item.mass")
                  .modal__about-stats-item-icon
                    img(src="@/assets/img/modals/fighter-weight-icon.png" alt="")
                  .modal__about-stats-item-text {{ item.mass }} {{ $t('fighters.kg') }}
                .modal__about-stats-item(v-if="age")
                  .modal__about-stats-item-icon
                    img(src="@/assets/img/modals/fighter-age-icon.png" alt="")
                  .modal__about-stats-item-text {{ $tc('fighters.years', age) }}
              .modal__about-item(v-if="item.wins || item.wins || item.wins")
                .modal__about-title {{ $t('fighters.statistics') }}
              .modal__about-stats
                .modal__about-stats-item(v-if="item.wins !== null")
                  .modal__about-stats-item-num {{ item.wins }}
                  .modal__about-stats-item-text {{ $t('fighters.wins') }}
                .modal__about-stats-item(v-if="item.draws !== null")
                  .modal__about-stats-item-num {{ item.draws }}
                  .modal__about-stats-item-text {{ $t('fighters.draws') }}
                .modal__about-stats-item(v-if="item.losses !== null")
                  .modal__about-stats-item-num {{ item.losses }}
                  .modal__about-stats-item-text {{ $t('fighters.losses') }}
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
</template>

<script>
import modals from '@/mixins/modals'
import { mapState } from 'vuex'
import store from '@/store'
import ModalSlider from '@/components/modals/ModalSlider'
import ModalPreloader from '@/components/modals/ModalPreloader'
import moment from 'moment'

export default {
  name: 'Fighter',
  components: { ModalPreloader, ModalSlider },
  mixins: [modals],
  computed: {
    ...mapState('fighters', ['item']),
    classList: vm => vm.$attrs.bodyClass ? vm.$attrs.bodyClass : [],
    age: vm => vm.item.birthdate ? moment().diff(moment(vm.item.birthdate), 'years') : null,
    photo: vm => vm.item.image ? vm.item.image : require('@/assets/img/riders/riders_stub.png')
  },
  mounted () {
    document.querySelector('body').classList.add(...this.classList)
  },
  destroyed () {
    document.querySelector('body').classList.remove(...this.classList)
  },
  async beforeRouteEnter (to, from, next) {
    try {
      await store.dispatch('fighters/showByCode', to.params.code)
      next()
    } catch (error) {
      next(error)
    }
  },
  metaInfo: vm => ({
    title: vm.item.name
  })
}
</script>
