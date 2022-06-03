<template lang="pug">
  .human-slider
    .human-slider__arrow.human-slider__arrow_left.animated(v-lazyload ref="arrow_left")
    .human-slider__arrow.human-slider__arrow_right.animated(v-lazyload ref="arrow_right")
    .human-slider__content
      RappersSliderItem(
        ref="card"
        v-for="item in items"
        :key="item.code"
        :item="item"
      )
    .human-slider__pager.animated(ref="pager")
      template(v-if="current && total") {{ current }} of {{ total }}
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'
import { mapState } from 'vuex'
import Swiper, { Navigation } from 'swiper'
import RappersSliderItem from '@/components/rappers/RappersSliderItem'

Swiper.use([Navigation])

export default {
  name: 'RappersSlider',
  components: {
    RappersSliderItem
  },
  data: () => ({
    swiper: null,
    timeline: null,
    current: null,
    total: null
  }),
  computed: {
    ...mapState('rappers', ['items'])
  },
  mounted () {
    window.addEventListener('resize', () => {
      this.initAnimation()
      this.initSlider()
    })

    inViewport(this.$el, this.initAnimation, 'half')
    this.initSlider()
  },
  methods: {
    initAnimation () {
      this.$nextTick(() => {
        if (this.timeline instanceof Object) {
          this.timeline.pause()
        }

        this.timeline = anime.timeline()
          .add({
            targets: this.$refs.card.map(item => item.$el),
            opacity: [0, 1],
            delay: anime.stagger(200),
            duration: 400,
            easing: 'easeOutQuad'
          })
          .add({
            targets: this.$refs.arrow_left,
            opacity: [0, 1],
            translateX: ['-100%', 0],
            duration: 400,
            easing: 'easeOutQuad'
          }, 800)
          .add({
            targets: this.$refs.arrow_right,
            opacity: [0, 1],
            translateX: ['100%', 0],
            duration: 400,
            easing: 'easeOutQuad'
          }, 800)
          .add({
            targets: this.$refs.pager,
            opacity: [0, 1],
            duration: 400,
            easing: 'easeOutQuad'
          }, 800)
      })
    },
    initSlider () {
      const vm = this

      this.$nextTick(() => {
        if (this.swiper) {
          this.swiper.update()
          this.swiper.slideTo(0)
        } else {
          this.swiper = new Swiper('.rappers .human-slider', {
            speed: 800,
            wrapperClass: 'human-slider__content',
            slideClass: 'human-card',
            slideActiveClass: 'human-card_active',
            breakpoints: {
              320: {
                slidesPerView: 1
              },
              1024: {
                slidesPerView: 3
              }
            },
            navigation: {
              nextEl: '.human-slider__arrow_right',
              prevEl: '.human-slider__arrow_left',
              disabledClass: 'human-slider__arrow_disabled'
            },
            on: {
              init: (swiper) => vm.calculate(swiper),
              slideChange: (swiper) => vm.calculate(swiper),
              resize: (swiper) => vm.calculate(swiper),
              update: (swiper) => vm.calculate(swiper)
            }
          })
        }
      })
    },
    calculate (swiper) {
      const slidesPerView = swiper.params.slidesPerView
      const length = swiper.slides.length
      const first = swiper.activeIndex + 1
      const last = first + slidesPerView - 1 > length ? length : first + slidesPerView - 1

      this.current = slidesPerView > 1
        ? first + '-' + last
        : first

      this.total = length
    }
  }
}
</script>
