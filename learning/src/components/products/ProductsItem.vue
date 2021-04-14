<template lang="pug">
  .products__choosen.products__choosen_original
    .products__choosen-can-splash.products__choosen-can-splash_1.lazyload.animated(ref="splash_1")
    .products__choosen-can-splash.products__choosen-can-splash_2.lazyload.animated(ref="splash_2")
    img.products__choosen-human.products__choosen-human_1.lazyload.animated(
      ref="human_1"
      :data-src="require('@/assets/img/products/products_human1.svg')"
      alt=""
    )
    img.products__choosen-human.products__choosen-human_2.lazyload.animated(
      ref="human_2"
      :data-src="require('@/assets/img/products/products_human2.svg')"
      alt=""
    )
    img.products__choosen-human.products__choosen-human_3.lazyload.animated(
      ref="human_3"
      :data-src="require('@/assets/img/products/products_human3.svg')"
      alt=""
    )
    img.products__choosen-can-hole-back.lazyload(
      ref="hole_back"
      :data-src="require('@/assets/img/products/products_hole_back.png')"
      alt=""
    )
    .products__choosen-can.lazyload.animated(ref="image")
    img.products__choosen-can-hole-front.lazyload(
      ref="hole_front"
      :data-src="require('@/assets/img/products/products_hole_front.png')"
      alt=""
    )
    .products__choosen-splatter.products__choosen-splatter_1.lazyload.animated(ref="splatter_1")
    .products__choosen-splatter.products__choosen-splatter_2.lazyload.animated(ref="splatter_2")
    .products__choosen-splatter.products__choosen-splatter_3.lazyload.animated(ref="splatter_3")
    .products__choosen-splatter.products__choosen-splatter_4.lazyload.animated(ref="splatter_4")
    .products__choosen-splatter.products__choosen-splatter_5.lazyload.animated(ref="splatter_5")
    .products__choosen-can-sublight.lazyload.animated(ref="sublight")
    .products__choosen-info.animated(ref="info")
      .products__choosen-bottle.product__bottle.lazyload
        .product__bottle-volume 0,3L
        .product__bottle-text New Bottle
      .products__choosen-info-content.products__choosen-info-content_original.lazyload
        .products__choosen-info-top.lazyload
          h2.product__choosen-name Original
          p Our technologists stirred up a ridiculous energy formula. There is twice as much relentless «GORILLA ENERGY» power in one can.
          p It does not matter who you are and where you are from, what matters is the power within you.
        .products__choosen-info-list
          ul
            li Vitamins C, B3, B5, B6, B7, B12
            li Guarana and Ginseng extract
            li Caffeine, Taurine, L-carnitine
            li No artificail colors
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'

const humanAnimationOptions = {
  original: [
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [190, 40], duration: 400 },
        { value: [40, 0], duration: 2600 }
      ]
    },
    {
      opacity: { value: [0, 1], duration: 400 },
      scale: { value: [0.6, 1], duration: 400 },
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
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [190, 40], duration: 400 },
        { value: [40, 0], duration: 2600 }
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
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [190, 40], duration: 400 },
        { value: [40, 0], duration: 2600 }
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
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [190, 40], duration: 400 },
        { value: [40, 0], duration: 2600 }
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
  california: [
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
      scale: { value: [0.6, 1], duration: 400 },
      rotate: { value: [0.1, 0.1], duration: 400 },
      translateX: [
        { value: [190, 40], duration: 400 },
        { value: [40, 0], duration: 2600 }
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

const currentCode = 'original'

export default {
  name: 'ProductsItem',
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        anime.timeline()
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
            ...humanAnimationOptions[currentCode][0],
            duration: 3000,
            easing: 'linear'
          }, 0)
          .add({
            targets: this.$refs.human_2,
            ...humanAnimationOptions[currentCode][1],
            duration: 3000,
            easing: 'linear'
          }, 200)
          .add({
            targets: this.$refs.human_3,
            ...humanAnimationOptions[currentCode][2],
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
      }, 'half')
    })
  }
}
</script>
