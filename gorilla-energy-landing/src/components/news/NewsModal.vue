<template lang="pug">
  ModalLayout(
    type="news"
    :active="active"
    @hide="hide"
  )
    .modal__content(v-if="item.id")
      .modal__top
        h2.modal__mobile-header
          .modal__mobile-header-link
          | {{ item.name }}
        h2.modal__news-header {{ item.name }}
      ModalSlider(:items="item.media_blocks")
      .modal__news-article(v-if="item.detail_text" v-html="item.detail_text")
    ModalPreloader(v-else)
</template>

<script>
import modals from '@/mixins/modals'
import { mapState } from 'vuex'
import ModalSlider from '@/components/modals/ModalSlider'
import ModalPreloader from '@/components/modals/ModalPreloader'

export default {
  name: 'NewsModal',
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
