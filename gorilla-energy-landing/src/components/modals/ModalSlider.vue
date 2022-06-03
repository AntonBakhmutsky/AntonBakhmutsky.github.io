<template lang="pug">
  .modal__slider(v-if="items.length")
    .modal__slider-arrow.modal__slider-arrow_left(v-if="items.length > 1")
    .modal__slider-arrow.modal__slider-arrow_right(v-if="items.length > 1")
    .modal__slider-wrap
      .modal__slider-content
        ModalSliderItem(
          v-for="item in items"
          :key="item.id"
          :item="item"
        )
    .modal__slider-pager
      template(v-if="current && total") {{ current }}/{{ total }}
</template>

<script>
import Swiper, { Navigation } from 'swiper'
import ModalSliderItem from '@/components/modals/ModalSliderItem'

Swiper.use([Navigation])

export default {
  name: 'ModalSlider',
  components: { ModalSliderItem },
  props: {
    items: {
      type: Array,
      default: () => ([]),
      required: false
    }
  },
  data: () => ({
    swiper: null,
    current: null,
    total: null
  }),
  watch: {
    items () {
      this.initSlider()
    }
  },
  mounted () {
    this.initSlider()
  },
  methods: {
    initSlider () {
      const vm = this

      this.$nextTick(() => {
        if (this.swiper) {
          this.swiper.update()
          this.swiper.slideTo(0)
        } else {
          this.swiper = new Swiper('.modal__slider-wrap', {
            speed: 800,
            wrapperClass: 'modal__slider-content',
            slideClass: 'modal__slider-slide',
            slideActiveClass: 'modal__slider-slide_active',
            slidesPerView: 1,
            navigation: {
              nextEl: '.modal__slider-arrow_right',
              prevEl: '.modal__slider-arrow_left',
              disabledClass: 'modal__slider-arrow_disabled'
            },
            on: {
              init: (swiper) => vm.calculate(swiper),
              slideChange: (swiper) => vm.calculate(swiper)
            }
          })
        }
      })
    },
    calculate (swiper) {
      this.current = swiper.activeIndex + 1
      this.total = swiper.slides.length
    }
  }
}
</script>
