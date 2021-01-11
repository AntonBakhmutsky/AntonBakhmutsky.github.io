<template lang="pug">
  .hidden-menu
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
          | Nurmagamedov
          span
            | Gorilla Energy
            br
            | Ambassador
</template>

<script>
export default {
  name: 'HeaderTopMobileMenu',
  data: () => ({
    links: [
      { title: 'Products', href: '#products' },
      { title: 'Gorilla Riders', href: '#riders' },
      { title: 'Fighters', href: '#fighters' },
      { title: 'News | Events', href: '#news' },
      { title: 'Contact us', href: '#contacts' },
      { title: 'Where to buy', href: '#map' },
      { title: 'Send message', href: 'javascript:' }
    ]
  })
}
</script>
