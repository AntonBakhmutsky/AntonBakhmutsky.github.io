<template lang="pug">
  header.header.rellax#header
    HeaderVideo
    .container
      HeaderTitle
      HeaderSocials
      HeaderCollection
</template>

<script>
import Rellax from 'rellax'
import anime from 'animejs'

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
      this.rellax()
      this.anime()
    })
  },
  methods: {
    rellax () {
      new Rellax('.header', {
        speed: -5
      })
    },
    anime () {
      const headerTop = document.querySelector('.header__top.animated')
      const headerSocialsLink = document.querySelectorAll('.header .header__socials-link.animated')
      const headerCollection = document.querySelector('.header .header__collection.animated')
      const headerTitle = document.querySelector('.header .header__title.animated')
      const headerTitleStroke = document.querySelector('.header .header__title-stroke.animated')

      anime.timeline()
        .add({
          targets: headerTop,
          opacity: [0, 1],
          top: [-220, 0],
          duration: 800,
          easing: 'easeInOutQuad'
        })
        .add({
          targets: headerSocialsLink,
          opacity: [0, 1],
          scale: [3, 1],
          translateX: ['50%', 0],
          translateY: ['50%', 0],
          duration: 400,
          delay: anime.stagger(200),
          easing: 'easeOutQuad'
        })
        .add({
          targets: headerCollection,
          opacity: [0, 1],
          translateY: ['50%', 0],
          duration: 400,
          easing: 'easeInOutQuad'
        })
        .add({
          targets: headerTitle,
          opacity: [0, 1],
          scale: [0.2, 1],
          duration: 200,
          easing: 'linear'
        })
        .add({
          targets: headerTitleStroke,
          opacity: [1, 1],
          width: [0, '100%'],
          duration: 400,
          easing: 'linear'
        })
    }
  }
}
</script>
