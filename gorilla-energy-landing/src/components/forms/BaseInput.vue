<template lang="pug">
  .form__item(:class="{ 'form__item_invalid': !!error }")
    .form__item-error {{ error }}
    label
      input.form__item-input(
        v-bind="$attrs"
        :class="{ 'form__item-input_active': !!value }"
        :value="value"
        @input="$emit('input', $event.target.value)"
        type="text"
        autocomplete="off"
      )
      span.form__item-label {{ label }}
</template>

<script>
export default {
  name: 'BaseInput',
  inheritAttrs: false,
  props: {
    label: String,
    value: String,
    error: String
  }
}
</script>
