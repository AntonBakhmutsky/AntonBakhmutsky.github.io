<template lang="pug">
  .modal(
    :class="[...classes, `modal__${type}`, { 'modal_active': active }]"
    v-tap="hide"
  )
    .modal__body
      .modal__close
      template(v-if="type !== 'product'")
        .modal__wrap
          .modal__wrap-lt
          .modal__wrap-ct
          .modal__wrap-rt
          .modal__wrap-lc
          .modal__wrap-rc
          .modal__wrap-lb
          .modal__wrap-cb
          .modal__wrap-rb
          slot
      template(v-else)
        slot
</template>

<script>
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

export default {
  props: {
    classes: {
      type: Array,
      default: () => ([])
    },
    type: {
      type: String,
      required: true
    },
    active: {
      type: Boolean,
      default: false
    }
  },
  watch: {
    active (value) {
      if (value) {
        disableBodyScroll(this.$el)
      } else {
        enableBodyScroll(this.$el)
      }
    }
  },
  methods: {
    hide (event) {
      if (
        event.target.classList.contains('modal') ||
        event.target.classList.contains('modal__close')
      ) {
        this.$emit('hide')
      }
    }
  }
}
</script>
