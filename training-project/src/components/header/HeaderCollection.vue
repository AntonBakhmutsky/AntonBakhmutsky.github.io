<template lang="pug">
  .header__collection.animated
    .header__collection-text
      | Coming soon
      br
      | Gorilla wear
      br
      span on shop.gorillaenergy.com
</template>

<script>
import anime from 'animejs'

export default {
  name: 'HeaderCollection',
  mounted () {
    this.$nextTick(() => {
      anime({
        targets: this.$el,
        opacity: [0, 1],
        translateY: ['50%', 0],
        duration: 400,
        delay: 1800,
        easing: 'easeInOutQuad'
      })
    })
  }
}
</script>
