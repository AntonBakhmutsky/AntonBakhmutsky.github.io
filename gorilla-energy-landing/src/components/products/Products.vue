<template lang="pug">
  section.products#products(v-lazyload)
    .products__broken-ground(v-lazyload)
    .container
      ProductsTitle
      ProductsSwitch
      template(v-if="items.length")
        ProductsList
        ProductsItem
        ProductsSlider
      template(v-else)
        ProductsPreloader
</template>

<script>
import { mapState } from 'vuex'
import store from '@/store'

import inViewport from '@/helpers/inViewport'

import ProductsTitle from './ProductsTitle'
import ProductsList from './ProductsList'
import ProductsItem from './ProductsItem'
import ProductsSlider from './ProductsSlider'
import ProductsPreloader from './ProductsPreloader'
import ProductsModal from './ProductsModal'
import ProductsSwitch from './ProductsSwitch'

export default {
  name: 'Products',
  components: {
    ProductsModal,
    ProductsPreloader,
    ProductsSlider,
    ProductsItem,
    ProductsList,
    ProductsTitle,
    ProductsSwitch
  },
  computed: {
    ...mapState('products', ['items']),
    ...mapState('siteVersions', {
      currentCountry: state => state.item
    })
  },
  watch: {
    currentCountry () {
      this.$nextTick(() => {
        inViewport(this.$el, this.fetch, 'offset')
      })
    }
  },
  methods: {
    async fetch () {
      await store.dispatch('enums/fetch')
      await store.dispatch('products/fetch')
    }
  }
}
</script>
