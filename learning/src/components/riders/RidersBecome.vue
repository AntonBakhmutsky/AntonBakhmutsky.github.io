<template lang="pug">
  .riders__become.animated(v-lazyload v-tap="showModal")
    .riders__become-text(v-html="$t('riders.become')")
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'

export default {
  name: 'RidersBecome',
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        anime({
          targets: this.$el,
          opacity: [0, 1],
          rotate: [-90, 0],
          duration: 400,
          easing: 'easeOutQuad'
        })
      }, 'half')
    })
  },
  methods: {
    showModal () {
      this.$modal.show('ModalFeedback', { type: 'become-rider' })
    }
  }
}
</script>
