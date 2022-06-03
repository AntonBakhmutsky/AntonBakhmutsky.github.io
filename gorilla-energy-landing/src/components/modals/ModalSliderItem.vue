<template lang="pug">
  .modal__slider-slide
    template(v-if="item.iframe")
      template(v-if="active || !item.image")
        .iframe(v-html="item.iframe")
      template(v-else)
        img(:src="item.image" alt="")
        .modal__slider-slide-play(v-tap="show")
    template(v-else)
      img(:src="item.image" alt="")
</template>

<script>
export default {
  name: 'ModalSliderItem',
  props: {
    item: {
      type: Object,
      required: true
    }
  },
  data: () => ({
    active: false
  }),
  methods: {
    show () {
      this.active = true
    }
  }
}
</script>
