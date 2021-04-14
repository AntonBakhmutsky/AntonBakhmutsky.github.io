<template lang="pug">
  section.contacts#contacts(v-lazyload)
    .contacts__bg-wrapper(v-lazyload)
      .container
        ContactsTitle
        ContactsContent
</template>

<script>
import ContactsTitle from '@/components/contacts/ContactsTitle'
import ContactsContent from '@/components/contacts/ContactsContent'

export default {
  name: 'Contacts',
  components: {
    ContactsContent,
    ContactsTitle
  }
}
</script>
