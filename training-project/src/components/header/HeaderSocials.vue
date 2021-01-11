<template lang="pug">
  .header__socials
    a.header__socials-link(
      v-for="item in socials"
      :key="item.code"
      :class="[ `header__socials-link_${item.code}` ]"
      :href="item.href"
      rel="noopener noreferrer"
    )
      img(:src="item.img" alt="")
</template>

<script>
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
  })
}
</script>
