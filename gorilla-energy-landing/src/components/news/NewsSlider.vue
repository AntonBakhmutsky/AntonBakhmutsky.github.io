<template lang="pug">
  .news-slider
    .news-slider__arrow.news-slider__arrow_left(v-lazyload)
    .news-slider__arrow.news-slider__arrow_right(v-lazyload)
    .news-slider__content
      NewsSliderItem(
        ref="items"
        v-for="item in items"
        :key="item.code"
        :item="item"
      )
    .news-slider__more.more-btn(
      v-if="hasMore"
      v-tap="() => fetch('more')"
      v-lazyload
    ) {{ $t('news.more') }}
    .news-slider__pager
      template(v-if="current") {{ current }}/{{ meta.total }}
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'
import { mapState, mapActions, mapGetters } from 'vuex'
import Swiper, { Navigation } from 'swiper'
import NewsSliderItem from '@/components/news/NewsSliderItem'

Swiper.use([Navigation])

export default {
  name: 'NewsSlider',
  components: { NewsSliderItem },
  data: () => ({
    swiper: null,
    current: null
  }),
  computed: {
    ...mapState('news', ['items', 'meta']),
    ...mapGetters('news', ['hasMore'])
  },
  watch: {
    items () {
      this.$nextTick(() => {
        this.$refs.items.forEach((item, index) => {
          this.initAnimation(item.$el, index)
        })
      })
    }
  },
  mounted () {
    this.$nextTick(() => {
      this.$refs.items.forEach((item, index) => {
        inViewport(item.$el, () => this.initAnimation(item.$el, index), 'half')
      })

      window.addEventListener('resize', this.initSlider)
      this.initSlider()
    })
  },
  methods: {
    ...mapActions('news', ['fetch']),
    initAnimation (card, index) {
      if (window.innerWidth > 1024) {
        if (!card.classList.contains('animated')) {
          return false
        }

        const x = [2, 3].includes(index % 4) ? '100%' : '-100%'
        const delay = [0, 3].includes(index % 4) ? 200 : 0

        anime({
          targets: card,
          opacity: [0, 1],
          translateX: [x, 0],
          duration: 400,
          delay: delay,
          easing: 'linear'
        })

        card.classList.remove('animated')
      }
    },
    initSlider () {
      if (window.innerWidth <= 1024) {
        if (!this.swiper) {
          const vm = this

          this.swiper = new Swiper('.news .news-slider', {
            speed: 800,
            spaceBetween: 80,
            wrapperClass: 'news-slider__content',
            slideClass: 'news-card',
            slideActiveClass: 'news-card_active',
            slidesPerView: 1,
            navigation: {
              nextEl: '.news-slider__arrow_right',
              prevEl: '.news-slider__arrow_left',
              disabledClass: 'news-slider__arrow_disabled'
            },
            on: {
              init: (swiper) => vm.calculate(swiper),
              slideChange: (swiper) => vm.calculate(swiper)
            }
          })
        }
      } else {
        if (this.swiper) {
          this.swiper.destroy()
          this.swiper = null
        }
      }
    },
    async calculate (swiper) {
      const length = swiper.slides.length
      const current = swiper.activeIndex + 1

      this.current = current

      if (this.hasMore && current === length) {
        await this.fetch('more')
        swiper.update()
      }
    }
  }
}
</script>
