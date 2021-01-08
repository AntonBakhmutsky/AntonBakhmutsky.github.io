<template lang="pug">
  #app
    Preloader
</template>

<script>
import '@/styles/app.sass'
import Preloader from '@/components/Preloader'

export default {
  name: 'App',
  components: {
    Preloader
  }
}
</script>
