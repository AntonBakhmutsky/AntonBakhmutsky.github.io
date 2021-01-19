<template lang="pug">
  .header__socials
    a.header__socials-link.animated(
      v-for="item in socials"
      ref="links"
      :key="item.code"
      :class="[ `header__socials-link_${item.code}` ]"
      :href="item.href"
      target="_blank"
      rel="noopener noreferrer"
    )
      img(:src="item.img" alt="")
</template>

<script>
import anime from 'animejs'

export default {
  name: 'HeaderSocials',
  data: () => ({
    socials: [
      {
        code: 'vk',
        img: require('@/assets/img/header/socials/header-vk.png'),
        href: 'https://vk.com/gorillaenergy'
      },
      {
        code: 'fb',
        img: require('@/assets/img/header/socials/header-fb.png'),
        href: 'https://facebook.com/gorillaenergy'
      },
      {
        code: 'ig',
        img: require('@/assets/img/header/socials/header-ig.png'),
        href: 'https://instagram.com/gorillaenergy'
      },
      {
        code: 'yt',
        img: require('@/assets/img/header/socials/header-yt.png'),
        href: 'https://youtube.com/gorillaenergy'
      }
    ]
  }),
  mounted () {
    this.$nextTick(() => {
      anime({
        targets: this.$refs.links,
        opacity: [0, 1],
        scale: [3, 1],
        translateX: ['50%', 0],
        translateY: ['50%', 0],
        duration: 400,
        delay: anime.stagger(200, { start: 800 }),
        easing: 'easeOutQuad'
      })
    })
  }
}
</script>
