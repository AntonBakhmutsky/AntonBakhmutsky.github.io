<script setup>
defineProps({
  modelValue: {
    type: Boolean,
    default: false
  }
})

defineEmits(['update:modelValue'])
</script>

<template>
  <label class="complete-btn" :class="modelValue && 'checked'">
    <input
        type="checkbox"
        :value="modelValue"
        @input="() => $emit('update:modelValue', !modelValue)"
        class="hidden"
    >
    {{ modelValue ? 'Completed' : 'Mark is complete' }}
  </label>
</template>

<style lang="sass" scoped>
    ::selection
      display: none
</style>