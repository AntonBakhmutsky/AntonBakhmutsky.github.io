<template lang="pug">
  .fighters__promo.animated(v-if="item")
    .fighters__promo-image(v-tap="showModal")
      img(v-lazyload :data-src="item.alt_image" alt="")
    .fighters__promo-image_hover(v-tap="showModal")
      img(v-lazyload :data-src="item.image" alt="" )
    .fighters__promo-info
      h2.fighters__promo-header(v-lazyload)
        span(v-html="displayName")
        br
        i(v-if="item.nickname") «{{ item.nickname }}»
      .fighters__promo-discipline(v-if="item.title") {{ item.title }}
      .fighters__promo-more.more-btn(
        v-tap="showModal"
        v-lazyload
      ) {{ $t('fighters.more') }}
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'
import { mapActions, mapState } from 'vuex'

export default {
  name: 'FightersPromo',
  computed: {
    ...mapState('fighters', ['items']),
    item: vm => vm.items.length ? vm.items[0] : null,
    displayName: vm => vm.item.name?.split(' ')?.join('<br>')
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        anime({
          targets: this.$el,
          opacity: [0, 1],
          duration: 400,
          easing: 'easeOutQuad'
        })
      }, 'half')
    })
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
