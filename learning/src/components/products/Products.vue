<template lang="pug">
  section.products.lazyload#products
    .products__broken-ground.lazyload
    .container
      ProductsTitle
      ProductsList
      ProductsItem
      ProductsSlider
</template>

<script>
import ProductsTitle from '@/components/products/ProductsTitle'
import ProductsList from '@/components/products/ProductsList'
import ProductsItem from '@/components/products/ProductsItem'
import ProductsSlider from '@/components/products/ProductsSlider'

export default {
  name: 'Products',
  components: {
    ProductsSlider,
    ProductsItem,
    ProductsList,
    ProductsTitle
  }
}
</script>
