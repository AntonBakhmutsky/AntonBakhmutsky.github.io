<template lang="pug">
  .contacts__content
    .contacts__content-image(v-lazyload)
    .contacts__content-text {{ $t('contacts.text') }}
    a.contacts__content-link(href="mailto:info@gorillaenergy.com") info@gorillaenergy.com
</template>

<script>
export default {
  name: 'ContactsContent'
}
</script>
