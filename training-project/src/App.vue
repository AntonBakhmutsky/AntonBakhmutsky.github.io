<template lang="pug">
  #app
    Preloader
    HeaderTop
    Header
</template>

<script>
import '@/styles/app.sass'
import Preloader from '@/components/Preloader'
import Header from '@/components/header/Header'
import HeaderTop from '@/components/header/HeaderTop'

export default {
  name: 'App',
  components: {
    HeaderTop,
    Header,
    Preloader
  }
}
</script>
