<template lang="pug">
  .hidden-header(
    v-lazyload
    :class="{ 'hidden-header_active': active }"
  )
    a.hidden-header__logo(href="#body")
      img(
        v-lazyload
        :data-src="require('@/assets/img/header/hidden/fixed_menu_logo.png')"
        alt=""
      )
    .hidden-header__menu
      RouterLink.hidden-header__menu-item(
        v-for="item in menu"
        :key="item.title"
        :class="{ 'hidden-header__menu-item_active': (item.to.hash || '').substr(1) === currentSection}"
        :to="item.to"
      ) {{ item.title }}
        .hidden-header__menu-item-back(v-lazyload)
    .colored__socials
      a.colored__socials-item(
        v-lazyload
        v-for="item in socials"
        :key="item.code"
        :class="`colored__socials-item_${item.code}`"
        :href="item.href"
        target="_blank"
        rel="noopener noreferrer"
      )
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'HeaderHidden',
  data: () => ({
    active: false,
    currentSection: null
  }),
  computed: {
    ...mapState('main', ['menu', 'socials'])
  },
  watch: {
    currentSection (value) {
      this.active = !!value
    }
  },
  mounted () {
    this.$nextTick(() => {
      const sections = document.querySelectorAll('main section')

      const listener = () => {
        this.currentSection = null

        sections.forEach(section => {
          if (section.style.display === 'none') {
            return false
          }

          const { top } = section.getBoundingClientRect()

          if (top <= window.innerHeight / 2) {
            this.currentSection = section.id
          }
        })
      }

      document.addEventListener('scroll', listener)
      listener()
    })
  }
}
</script>
