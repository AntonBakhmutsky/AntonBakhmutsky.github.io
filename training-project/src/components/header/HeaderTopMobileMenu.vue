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
          a.hidden-menu__item.hidden-menu__item_fighter(
            v-html="$t('header.ambassador')"
            href="javascript:"
          )
</template>

<script>
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

export default {
  name: 'HeaderTopMobileMenu',
  data: vm => ({
    active: false,
    links: [
      { title: vm.$t('products.title'), href: '#products' },
      { title: vm.$t('riders.title'), href: '#riders' },
      { title: vm.$t('fighters.title'), href: '#fighters' },
      { title: vm.$t('news.title'), href: '#news' },
      { title: vm.$t('contacts.title'), href: '#contacts' },
      { title: vm.$t('map.title'), href: '#map' },
      { title: vm.$t('header.feedback'), href: 'javascript:' }
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
