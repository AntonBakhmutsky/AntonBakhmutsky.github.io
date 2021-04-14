<template lang="pug">
  #app
    HeaderTop
    RouterView
    Footer(v-if="!hideFooter")
    ProductsModal
    RidersModal
    FightersModal
    NewsModal
    NewsModalPoster
    ModalFeedback
</template>

<script>
import HeaderTop from '@/components/header/HeaderTop'
import HeaderHidden from '@/components/header/HeaderHidden'
import Footer from '@/components/footer/Footer'
import ProductsModal from '@/components/products/ProductsModal'
import RidersModal from '@/components/riders/RidersModal'
import FightersModal from '@/components/fighters/FightersModal'
import NewsModal from '@/components/news/NewsModal'
import NewsModalPoster from '@/components/news/NewsModalPoster'
import ModalFeedback from '@/components/modals/ModalFeedback'

export default {
  name: 'MainLayout',
  components: {
    HeaderTop,
    HeaderHidden,
    Footer,
    ModalFeedback,
    ProductsModal,
    RidersModal,
    FightersModal,
    NewsModal,
    NewsModalPoster
  },
  computed: {
    hideFooter: vm => ['404'].includes(vm.$route.name)
  }
}
</script>
