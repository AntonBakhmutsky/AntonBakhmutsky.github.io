<template lang="pug">
  .form__item.form__item_file(:class="{ 'form__item_invalid': !!error }")
    .form__item-message {{ error || label }}
    label
      input.form__item-input(
        type="file"
        accept="image/x-png,image/gif,image/jpeg"
        v-bind="$attrs"
        @change="onFileChange"
      )
      span.form__item-label(v-if="file")
        span {{ file.name }} ({{ file.size | filesize }})
      span.form__item-label(v-else)
        span {{ $t('feedback.file') }}
</template>

<script>
export default {
  name: 'BaseFile',
  inheritAttrs: false,
  props: {
    label: String,
    value: String,
    error: String
  },
  data: () => ({
    file: null
  }),
  methods: {
    onFileChange (e) {
      this.file = null

      const files = e.target.files

      if (!files.length) {
        return
      }

      this.file = files[0]
    }
  }
}
</script>
