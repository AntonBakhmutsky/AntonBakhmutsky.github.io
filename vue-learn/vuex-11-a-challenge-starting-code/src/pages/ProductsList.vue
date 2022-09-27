<template lang="pug">
section
  ul
    ProductItem(
      v-for='prod in products'
      :key='prod.id'
      :id='prod.id'
      :title='prod.title'
      :image='prod.image'
      :description='prod.description'
      :price='prod.price'
    )
</template>

<script>
import ProductItem from '../components/products/ProductItem.vue';

export default {
  inject: ['products'],
  components: {
    ProductItem,
  },
};
</script>

<style scoped lang="sass">
  ul
    list-style: none
    margin: 2rem auto
    padding: 0
    max-width: 40rem
</style>