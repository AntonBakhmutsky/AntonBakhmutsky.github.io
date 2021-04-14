<template lang="pug">
  div
    .header__mobile-menu-btn(v-tap="show")
    .header__mobile-overlay(
      :class="{ 'header__mobile-overlay_active': active }"
      v-tap="hide"
    )
    .hidden-menu(:class="{ 'hidden-menu_active': active }")
      .hidden-menu__inner(ref="menuInner")
        .hidden-menu__content
          RouterLink.hidden-menu__item(
            v-tap="hide"
            v-for="item in menu"
            :key="item.title"
            :to="item.to"
          ) {{ item.title }}
          .hidden-menu__item(v-tap="showModal")
            | {{ $t('header.feedback') }}
          RouterLink.hidden-menu__item.hidden-menu__item_fighter(
            v-tap="hide"
            :to="{ name: 'fighter', params: { code: 'khabib-nurmagomedov' } }"
            v-html="$t('header.ambassador')"
          )
</template>

<script>
import { mapState } from 'vuex'
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'

export default {
  name: 'HeaderTopMobileMenu',
  data: () => ({
    active: false
  }),
  computed: {
    ...mapState('main', ['menu'])
  },
  watch: {
    active (value) {
      if (value) {
        disableBodyScroll(this.$refs.menuInner)
      } else {
        enableBodyScroll(this.$refs.menuInner)
      }
    }
  },
  methods: {
    show () {
      this.active = true
    },
    hide () {
      this.active = false
    },
    showModal () {
      this.$modal.show('ModalFeedback')
    }
  }
}
</script>
