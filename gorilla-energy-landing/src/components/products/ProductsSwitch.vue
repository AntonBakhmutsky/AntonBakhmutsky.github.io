<template lang="pug">
  .products__switch.animated(v-show="showSwitch")
    template(v-for="(item, index) in productTypes")
      .products__switch-item(
        :key="index"
        :class="[ { 'products__switch-item_selected': type === item.value }, `products__switch-item_${item.key.toLowerCase()}` ]"
        @click="switchType(item.value)"
        v-lazyload
      ) {{ item.description }}
      .products__switch-delimiter(
        v-if="index < productTypes.length - 1"
        v-lazyload
      )
</template>

<script>
import inViewport from '@/helpers/inViewport'
import anime from 'animejs'

import { mapMutations, mapState, mapActions } from 'vuex'

export default {
  name: 'ProductsSwitch',
  computed: {
    ...mapState('products', ['type']),
    ...mapState('enums', ['productTypes']),
    showSwitch: vm => vm.$i18n.locale !== 'by' && vm.$i18n.locale !== 'ua'
  },
  mounted () {
    this.$nextTick(() => {
      inViewport(this.$el, () => {
        anime({
          targets: this.$el,
          opacity: [0, 1],
          duration: 200,
          easing: 'linear'
        })
      }, 'bottom')
    })
  },
  methods: {
    ...mapMutations('products', ['SET_TYPE']),
    ...mapActions('products', ['fetch']),
    async switchType (value) {
      this.SET_TYPE(value)
      await this.fetch()
    }
  }
}
</script>
