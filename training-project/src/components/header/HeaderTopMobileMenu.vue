<template lang="pug">
  div
    .header__mobile-menu-btn(
      @click="active = true"
    )
    .header__mobile-overlay(
      :class="{ 'header__mobile-overlay_active': active }"
      @click="active = false"
    )
    .hidden-menu(
      ref="menu"
      :class="{ 'hidden-menu_active': active }"
    )
      .hidden-menu__inner
        .hidden-menu__content
          a.hidden-menu__item(
            v-for="item in links"
            :key="item.href"
            :href="item.href"
          ) {{ item.title }}
          a.hidden-menu__item.hidden-menu__item_fighter(href="javascript:")
            | Khabib
            br
            | Nurmagomedov
            span
              | Gorilla Energy
              br
              | Ambassador
</template>

<script>
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

export default {
  name: 'HeaderTopMobileMenu',
  data: () => ({
    active: false,
    links: [
      { title: 'Products', href: '#products' },
      { title: 'Gorilla Riders', href: '#riders' },
      { title: 'Fighters', href: '#fighters' },
      { title: 'News | Events', href: '#news' },
      { title: 'Contact us', href: '#contacts' },
      { title: 'Where to buy', href: '#map' },
      { title: 'Send message', href: 'javascript:' }
    ]
  }),
  watch: {
    active (value) {
      if (value) {
        disableBodyScroll(this.$refs.menu)
      } else {
        enableBodyScroll(this.$refs.menu)
      }
    }
  }
}
</script>
