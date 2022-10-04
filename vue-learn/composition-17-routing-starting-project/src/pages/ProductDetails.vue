<template lang="pug">
section
  h2 {{ title }}
  h3 ${{ price}}
  p {{ description}}
</template>

<script>
import { inject } from 'vue';

export default {
  props: ['pid'],
  setup(props) {
    const products = inject('products');

    const selectedProduct = products.value.find(product => product.id === props.pid);
    const title = selectedProduct.title;
    const price = selectedProduct.price;
    const description = selectedProduct.description;

    return { title, price, description };
  },
};
</script>


<style lang="sass" scoped>
section
  margin: 3rem auto
  max-width: 40rem
  padding: 1rem
  border-radius: 12px
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26)
</style>