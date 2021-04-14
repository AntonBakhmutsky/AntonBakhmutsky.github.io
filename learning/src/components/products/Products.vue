<template lang="pug">
  section.products#products(v-lazyload)
    .products__broken-ground(v-lazyload)
    .container
      ProductsTitle
      template(v-if="items.length")
        ProductsList
        ProductsItem
        ProductsSlider
      template(v-else)
        ProductsPreloader
</template>

<script>
import { mapState, mapActions } from 'vuex'
import inViewport from '@/helpers/inViewport'

import ProductsTitle from './ProductsTitle'
import ProductsList from './ProductsList'
import ProductsItem from './ProductsItem'
import ProductsSlider from './ProductsSlider'
import ProductsPreloader from './ProductsPreloader'
import ProductsModal from './ProductsModal'

export default {
  name: 'Products',
  components: {
    ProductsModal,
    ProductsPreloader,
    ProductsSlider,
    ProductsItem,
    ProductsList,
    ProductsTitle
  },
  computed: {
    ...mapState('products', ['items'])
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, this.fetch, 'offset')
    })
  },
  methods: {
    ...mapActions('products', ['fetch'])
  }
}
</script>
