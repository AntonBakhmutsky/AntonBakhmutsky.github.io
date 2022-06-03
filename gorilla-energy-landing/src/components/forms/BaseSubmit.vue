<template lang="pug">
  .form__submit
    .form__item.form__item_submit
      label
        input.form__item-input(
          type="submit"
          :value="label"
          :disabled="disabled"
        )
</template>

<script>
export default {
  name: 'BaseSubmit',
  props: {
    label: String,
    disabled: Boolean
  }
}
</script>
