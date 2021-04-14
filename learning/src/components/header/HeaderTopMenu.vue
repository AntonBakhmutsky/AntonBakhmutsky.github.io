<template lang="pug">
  .header__menu
    .header__menu-left
      a.header__menu-item(
        v-for="item in leftMenu"
        :key="item.href"
        :class="[ `header__menu-item_${item.modifier}` ]"
        :href="item.href"
      ) {{ item.title }}
    .header__menu-logo
    .header__menu-right
      a.header__menu-item(
        v-for="item in rightMenu"
        :key="item.href"
        :class="[ `header__menu-item_${item.modifier}` ]"
        :href="item.href"
      ) {{ item.title }}
</template>

<script>
export default {
  name: 'HeaderTopMenu',
  data: vm => ({
    leftMenu: [
      { title: vm.$t('products.title'), href: '#products' },
      { title: vm.$t('riders.title'), href: '#riders' },
      { title: vm.$t('fighters.title'), href: '#fighters' },
      { title: vm.$t('news.title'), href: '#news' }
    ],
    rightMenu: [
      { title: vm.$t('contacts.title'), href: '#contacts' },
      { title: vm.$t('map.title'), href: '#map' },
      { title: vm.$t('header.feedback'), href: 'javascript:', modifier: 'feedback' }
    ]
  })
}
</script>
