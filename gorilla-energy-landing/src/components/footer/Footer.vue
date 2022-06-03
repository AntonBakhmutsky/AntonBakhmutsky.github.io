<template lang="pug">
  footer.footer(v-lazyload)
    .container
      .footer__content
        .footer__copyright
          span © 2022,
          span «Gorilla Drinks Limited»
        HeaderSocials
        .footer__design
          span Amathountos, 50E, PEARL BUILDING, 3rd Floor,
          span Office 1, Agios Tychonas, 4532, Limassol, Cyprus
</template>

<script>
import HeaderSocials from '@/components/header/HeaderSocials'

export default {
  name: 'Footer',
  components: {
    HeaderSocials
  }
}
</script>
