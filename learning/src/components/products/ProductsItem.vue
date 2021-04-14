<template lang="pug">
  .products__choosen(:class="`products__choosen_${item.code}`")
    .products__choosen-can-splash.products__choosen-can-splash_1.animated(ref="splash_1" v-lazyload)
    .products__choosen-can-splash.products__choosen-can-splash_2.animated(ref="splash_2" v-lazyload)
    img.products__choosen-human.products__choosen-human_1.animated(
      ref="human_1"
      v-lazyload
      :data-src="require('@/assets/img/products/products_human1.svg')"
      alt=""
    )
    img.products__choosen-human.products__choosen-human_2.animated(
      ref="human_2"
      v-lazyload
      :data-src="require('@/assets/img/products/products_human2.svg')"
      alt=""
    )
    img.products__choosen-human.products__choosen-human_3.animated(
      ref="human_3"
      v-lazyload
      :data-src="require('@/assets/img/products/products_human3.svg')"
      alt=""
    )
    img.products__choosen-can-hole-back(
      ref="hole_back"
      v-lazyload
      :data-src="require('@/assets/img/products/products_hole_back.png')"
      alt=""
    )
    .products__choosen-can.animated(ref="image" v-lazyload)
    img.products__choosen-can-hole-front(
      ref="hole_front"
      v-lazyload
      :data-src="require('@/assets/img/products/products_hole_front.png')"
      alt=""
    )
    .products__choosen-splatter.products__choosen-splatter_1.animated(ref="splatter_1" v-lazyload)
    .products__choosen-splatter.products__choosen-splatter_2.animated(ref="splatter_2" v-lazyload)
    .products__choosen-splatter.products__choosen-splatter_3.animated(ref="splatter_3" v-lazyload)
    .products__choosen-splatter.products__choosen-splatter_4.animated(ref="splatter_4" v-lazyload)
    .products__choosen-splatter.products__choosen-splatter_5.animated(ref="splatter_5" v-lazyload)
    .products__choosen-can-sublight.animated(ref="sublight" v-lazyload)
    .products__choosen-info.animated(ref="info")
      .products__choosen-bottle.product__bottle(
        v-lazyload
        :class="`product__bottle_${item.code}`"
      )
        .product__bottle-volume {{ $t(`products.bottle.${item.code}.volume`) }}
        .product__bottle-text {{ $t(`products.bottle.${item.code}.text`) }}
      .products__choosen-info-content(v-lazyload :class="`products__choosen-info-content_${item.code}`")
        .products__choosen-info-top(v-lazyload)
          h2.product__choosen-name {{ item.name }}
          div(v-html="item.description")
        .products__choosen-info-list(v-html="item.composition")
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'

import { mapState } from 'vuex'

const humanAnimationOptions = {
  mango: [
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [220, 45], duration: 400 },
        { value: [45, 0], duration: 2600 }
      ],
      translateY: [
        { value: [100, 20], duration: 400 },
        { value: [20, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scaleX: { value: [-0.6, -1], duration: 400 },
      scaley: { value: [0, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [-190, -40], duration: 400 },
        { value: [-40, 0], duration: 2600 }
      ],
      translateY: [
        { value: [-20, -4], duration: 400 },
        { value: [-4, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [-15, -15], duration: 400 },
      translateX: [
        { value: [-100, -20], duration: 400 },
        { value: [-20, 0], duration: 2600 }
      ],
      translateY: [
        { value: [50, 10], duration: 400 },
        { value: [10, 0], duration: 2600 }
      ]
    }
  ],
  original: [
    {
      opacity: { value: [0, 1], duration: 600 },
      scale: { value: [0.6, 1], duration: 0 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [190, 40], duration: 400 },
        { value: [40, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scaleX: { value: 1, duration: 0 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [-190, -40], duration: 400 },
        { value: [-40, 0], duration: 2600 }
      ],
      translateY: [
        { value: [51, 11], duration: 400 },
        { value: [11, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [-152, -32], duration: 400 },
        { value: [-32, 0], duration: 2600 }
      ],
      translateY: [
        { value: [29, 6], duration: 400 },
        { value: [6, 0], duration: 2600 }
      ]
    }
  ],
  orange: [
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [220, 45], duration: 400 },
        { value: [45, 0], duration: 2600 }
      ],
      translateY: [
        { value: [110, 22], duration: 400 },
        { value: [22, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scaleX: { value: [-0.6, -1], duration: 400 },
      scaley: { value: [0, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [-190, -40], duration: 400 },
        { value: [-40, 0], duration: 2600 }
      ],
      translateY: [
        { value: [-20, -4], duration: 400 },
        { value: [-4, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scaleX: { value: [0.6, 1], duration: 400 },
      rotate: { value: [-15, -15], duration: 400 },
      translateX: [
        { value: [-152, -32], duration: 400 },
        { value: [-32, 0], duration: 2600 }
      ],
      translateY: [
        { value: [50, 10], duration: 400 },
        { value: [10, 0], duration: 2600 }
      ]
    }
  ],
  ice: [
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [220, 45], duration: 400 },
        { value: [45, 0], duration: 2600 }
      ],
      translateY: [
        { value: [-50, -10], duration: 400 },
        { value: [-10, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scaleX: { value: [-0.6, -1], duration: 400 },
      scaley: { value: [0, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [-190, -40], duration: 400 },
        { value: [-40, 0], duration: 2600 }
      ],
      translateY: [
        { value: [20, 4], duration: 400 },
        { value: [4, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [-30, -30], duration: 400 },
      translateX: [
        { value: [-100, -20], duration: 400 },
        { value: [-20, 0], duration: 2600 }
      ],
      translateY: [
        { value: [50, 10], duration: 400 },
        { value: [10, 0], duration: 2600 }
      ]
    }
  ],
  pomegranate: [
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [220, 45], duration: 400 },
        { value: [45, 0], duration: 2600 }
      ],
      translateY: [
        { value: [100, 20], duration: 400 },
        { value: [20, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scaleX: { value: [-0.6, -1], duration: 400 },
      scaleY: { value: [0, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [-190, -40], duration: 400 },
        { value: [-40, 0], duration: 2600 }
      ],
      translateY: [
        { value: [-20, -4], duration: 400 },
        { value: [-4, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [-15, -15], duration: 400 },
      translateX: [
        { value: [-100, -20], duration: 400 },
        { value: [-20, 0], duration: 2600 }
      ],
      translateY: [
        { value: [50, 10], duration: 400 },
        { value: [10, 0], duration: 2600 }
      ]
    }
  ],
  pepper: [
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [220, 45], duration: 400 },
        { value: [45, 0], duration: 2600 }
      ],
      translateY: [
        { value: [110, 22], duration: 400 },
        { value: [22, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scaleX: { value: [-0.6, -1], duration: 400 },
      scaleY: { value: [0, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [-190, -40], duration: 400 },
        { value: [-40, 0], duration: 2600 }
      ],
      translateY: [
        { value: [-50, -10], duration: 400 },
        { value: [-10, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [-20, -20], duration: 400 },
      translateX: [
        { value: [-100, -20], duration: 400 },
        { value: [-20, 0], duration: 2600 }
      ],
      translateY: [
        { value: [60, 12], duration: 400 },
        { value: [12, 0], duration: 2600 }
      ]
    }
  ]
}

export default {
  name: 'ProductsItem',
  data: () => ({
    timeline: null
  }),
  computed: {
    ...mapState('products', ['item'])
  },
  watch: {
    item () {
      this.initAnimation()
    }
  },
  mounted () {
    inViewport(this.$el, this.initAnimation, 'half')
  },
  methods: {
    initAnimation () {
      this.$nextTick(() => {
        if (this.timeline instanceof Object) {
          this.timeline.pause()
        }

        this.timeline = anime.timeline()
          .add({
            targets: this.$refs.image,
            opacity: [0, 1],
            scale: [0, 1],
            duration: 400,
            easing: 'easeOutExpo'
          }, 0)
          .add({
            targets: this.$refs.splash_1,
            opacity: [0, 1],
            scale: [0, 1],
            duration: 400,
            easing: 'easeOutQuad'
          }, 100)
          .add({
            targets: this.$refs.splash_2,
            opacity: [0, 1],
            scale: [0, 1],
            duration: 400,
            easing: 'easeOutQuad'
          }, 300)
          .add({
            targets: this.$refs.human_1,
            ...humanAnimationOptions[this.item.code][0],
            duration: 3000,
            easing: 'linear'
          }, 0)
          .add({
            targets: this.$refs.human_2,
            ...humanAnimationOptions[this.item.code][1],
            duration: 3000,
            easing: 'linear'
          }, 200)
          .add({
            targets: this.$refs.human_3,
            ...humanAnimationOptions[this.item.code][2],
            duration: 3000,
            easing: 'linear'
          }, 400)
          .add({
            targets: this.$refs.splatter_1,
            opacity: [0, 1],
            scale: [0.1, 1],
            duration: 800,
            easing: 'easeOutExpo'
          }, 200)
          .add({
            targets: this.$refs.splatter_2,
            opacity: [0, 1],
            scale: [0.3, 1],
            duration: 800,
            easing: 'easeOutExpo'
          }, 200)
          .add({
            targets: this.$refs.splatter_3,
            opacity: [0, 1],
            scale: [0.5, 1],
            duration: 800,
            easing: 'easeOutExpo'
          }, 200)
          .add({
            targets: this.$refs.splatter_4,
            opacity: [0, 1],
            scale: [0.8, 1],
            translateX: [-100, 0],
            duration: 800,
            easing: 'easeOutExpo'
          }, 200)
          .add({
            targets: this.$refs.splatter_5,
            opacity: [0, 1],
            scale: [0.5, 1],
            duration: 800,
            easing: 'easeOutExpo'
          }, 200)
          .add({
            targets: this.$refs.sublight,
            opacity: [
              { value: [0, 1], duration: 800 },
              { value: [1, 0], duration: 800 }
            ],
            direction: 'alternate',
            easing: 'easeOutQuad'
          }, 400)
          .add({
            targets: this.$refs.info,
            opacity: [0, 1],
            translateX: ['50%', 0],
            duration: 400,
            easing: 'easeOutQuad'
          }, 400)
      })
    }
  }
}
</script>
