<template lang="pug">
  footer.footer(v-lazyload)
    .container
      .footer__content
        .footer__copyright
          span © 2010 – 2020,
          span «Premier Beverages P.B. Limited»
        HeaderSocials
        .footer__design
          span 1065, Nicosia, Cyprus
          span Arch. Makariou III, 2 - 4,« Capital Center», 9th floor
    div.footer__create
      a(
        :href="$t('create.link')"
        target="_blank"
        rel="noopener noreferrer"
        v-html="$t('create.text')"
      )
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
