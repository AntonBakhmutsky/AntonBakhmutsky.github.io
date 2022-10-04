<template lang="pug">
section
  h2 Add a products
  form(@submit.prevent='submitForm')
    div
      label(for='title') Title
      input#title(type='text' v-model='enteredTitle')
    div
      label(for='price') Price
      input#price(type='number' v-model.number='enteredPrice')
    div
      label(for='description') Description
      textarea#description(rows='5' v-model='enteredDescription')
    button Add Product
</template>

<script>
import { ref, inject } from 'vue';

export default {
  setup() {
    const addProduct = inject('addProduct');

    const enteredTitle = ref('');
    const enteredPrice = ref(null);
    const enteredDescription = ref('');

    function submitForm() {
      addProduct({
        title: enteredTitle,
        description: enteredDescription,
        price: enteredPrice,
      });
    }

    return {
      enteredTitle,
      enteredPrice,
      enteredDescription,
      submitForm,
    };
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

input, label, textarea
  display: block
  width: 100%

label
  font-weight: bold

input, textarea
  font: inherit
  margin-bottom: 0.5rem

button
  font: inherit
  background-color: #570080
  border: 1px solid #570080
  color: white
  padding: 0.5rem 1.5rem
  cursor: pointer

  &:hover, &:active
    background-color: #220031
    border-color: #220031
</style>