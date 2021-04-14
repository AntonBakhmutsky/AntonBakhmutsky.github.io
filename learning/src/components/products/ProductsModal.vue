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
      .modal__product-bottle.product__bottle(v-if="item.code === 'original'")
        .product__bottle-volume {{ $t(`products.bottle.${item.code}.volume`) }}
        .product__bottle-text {{ $t(`products.bottle.${item.code}.text`) }}
      .modal__product-list(v-html="item.composition")
</template>

<script>
import modals from '@/mixins/modals'
import { mapState } from 'vuex'

export default {
  name: 'ProductsModal',
  mixins: [modals],
  computed: {
    ...mapState('products', ['item'])
  }
}
</script>
