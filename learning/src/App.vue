<template lang="pug">
  #app
    Preloader
    HeaderTop
    Header
    main
      Products
</template>

<script>
import '@/styles/app.sass'
import Preloader from '@/components/Preloader'
import Header from '@/components/header/Header'
import HeaderTop from '@/components/header/HeaderTop'
import Products from '@/components/products/Products'

export default {
  name: 'App',
  components: {
    Products,
    HeaderTop,
    Header,
    Preloader
  }
}
</script>
