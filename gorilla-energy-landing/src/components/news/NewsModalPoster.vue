<template lang="pug">
  ModalLayout(
    type="poster"
    :active="active"
    @hide="hide"
  )
    .modal__content(v-if="item.id")
      h2.modal__mobile-header
        .modal__mobile-header-link
        | {{ item.name }}
      .modal__poster-image
        img(:src="item.detail_image" alt="")
      .modal__poster-info
        h2 {{ item.name }}
        div(v-html="item.detail_text")
    ModalPreloader(v-else)
</template>

<script>
import modals from '@/mixins/modals'
import { mapState } from 'vuex'
import ModalSlider from '@/components/modals/ModalSlider'
import ModalPreloader from '@/components/modals/ModalPreloader'

export default {
  name: 'NewsModalPoster',
  components: {
    ModalPreloader,
    ModalSlider
  },
  mixins: [modals],
  computed: {
    ...mapState('news', ['item'])
  }
}
</script>
