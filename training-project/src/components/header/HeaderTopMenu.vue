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
  data: () => ({
    leftMenu: [
      { title: 'Products', href: '#products' },
      { title: 'Gorilla Riders', href: '#riders' },
      { title: 'Fighters', href: '#fighters' },
      { title: 'News | Events', href: '#news' }
    ],
    rightMenu: [
      { title: 'Contact us', href: '#contacts' },
      { title: 'Where to buy', href: '#map' },
      { title: 'Send message', href: 'javascript:', modifier: 'feedback' }
    ]
  })
}
</script>
