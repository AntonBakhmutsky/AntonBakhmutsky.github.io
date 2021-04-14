<template lang="pug">
  div
    .products__choose.animated(
      ref="choose"
      v-html="$t('products.choose')"
    )
    .products__list(ref="list")
      .products__list-item-wrapper.animated(
        ref="wrapper"
        v-for="product in items"
        :key="product.code"
        v-tap="() => SET_ITEM(product)"
      )
        .products__list-item(
          v-lazyload
          :class="[{'products__list-item_active': product.code === item.code}, `products__list-item_${product.code}`]"
        ) {{ product.name }}
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'
import { mapState, mapMutations } from 'vuex'

export default {
  name: 'ProductsList',
  computed: {
    ...mapState('products', ['items', 'item'])
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$refs.list, () => {
        anime.timeline()
          .add({
            targets: this.$refs.wrapper,
            opacity: [0, 1],
            scale: [2, 1],
            translateY: ['50%', 0],
            duration: 400,
            delay: anime.stagger(200),
            easing: 'easeOutQuad'
          })
          .add({
            targets: this.$refs.choose,
            opacity: [0, 1],
            translateX: ['-50%', 0],
            duration: 200,
            easing: 'easeOutQuad'
          })
      }, 'bottom')
    })
  },
  methods: {
    ...mapMutations('products', ['SET_ITEM'])
  }
}
</script>
