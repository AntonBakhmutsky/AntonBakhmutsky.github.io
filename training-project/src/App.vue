<template lang="pug">
  #app
    Preloader
    HeaderTop
    Header
</template>

<script>
import '@/styles/app.sass'
import Preloader from '@/components/Preloader'
import HeaderTop from '@/components/header/HeaderTop'
import Header from '@/components/header/Header'

export default {
  name: 'App',
  components: {
    HeaderTop,
    Header,
    Preloader
  }
}
</script>
