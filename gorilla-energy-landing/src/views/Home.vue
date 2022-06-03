<template lang="pug">
  main.main
    HeaderHidden
    Header
    Products
    Rappers(v-if="$te('rappers.title')")
    Riders
    Fighters(v-if="$te('fighters.title')")
    News
    Socials
    Contacts
    Map
</template>

<script>
import HeaderHidden from '@/components/header/HeaderHidden'
import Header from '@/components/header/Header'
import Products from '@/components/products/Products'
import Riders from '@/components/riders/Riders'
import Fighters from '@/components/fighters/Fighters'
import News from '@/components/news/News'
import Socials from '@/components/socials/Socials'
import Contacts from '@/components/contacts/Contacts'
import Rappers from '@/components/rappers/Rappers'

export default {
  name: 'Home',
  components: {
    HeaderHidden,
    Header,
    Products,
    Rappers,
    Riders,
    Fighters,
    News,
    Socials,
    Contacts
  }
}
</script>
