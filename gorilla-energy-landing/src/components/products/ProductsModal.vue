<template lang="pug">
  ModalLayout(
    type="product"
    :classes="[`modal__product_${item.code}`]"
    :active="active"
    @hide="hide"
  )
    .modal__product-content(:class="`modal__product-content_${item.code}`")
      h2.modal__product-header {{ item.name }}
      .modal__product-text(v-html="item.description")
      .modal__product-nutritional(v-if="item.nutritional")
        .modal__product-nutritional-content(
          v-html="item.nutritional"
          :style="{ maxHeight: `${nutritionalHeight}px` }"
        )
        .modal__product-nutritional-btn(
          :class="{ 'modal__product-nutritional-btn_active': isActive }"
          @click="toggleNutritional"
        )
          span {{ btnTxt }}
      .modal__product-list(v-html="item.composition")
</template>

<script>
import modals from '@/mixins/modals'
import { mapState } from 'vuex'

export default {
  name: 'ProductsModal',
  mixins: [modals],
  data: () => ({
    isActive: false
  }),
  computed: {
    ...mapState('products', ['item']),
    btnTxt () {
      return this.isActive ? this.$t('products.info.collapse') : this.$t('products.info.expand')
    },
    nutritionalHeight () {
      return this.isActive ? document.querySelector('.modal__product-nutritional-content').scrollHeight : 0
    }
  },
  methods: {
    toggleNutritional () {
      this.isActive = !this.isActive
    }
  }
}
</script>
