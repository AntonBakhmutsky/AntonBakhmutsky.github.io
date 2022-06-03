<template lang="pug">
  .form__item.form__item_area(:class="{ 'form__item_invalid': !!error }")
    .form__item-error {{ error }}
    label
      textarea.form__item-textarea(
        v-bind="$attrs"
        :class="{ 'form__item-input_active': !!value }"
        :value="value"
        @input="$emit('input', $event.target.value)"
      )
      label.form__item-label {{ label }}
</template>

<script>
export default {
  name: 'BaseTextarea',
  inheritAttrs: false,
  props: {
    label: String,
    value: String,
    error: String
  }
}
</script>
