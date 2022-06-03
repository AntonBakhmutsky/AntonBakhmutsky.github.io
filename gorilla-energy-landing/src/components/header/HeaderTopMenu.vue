<template lang="pug">
  .header__menu
    .header__menu-left
      RouterLink.header__menu-item(
        v-for="item in left"
        :key="item.title"
        :to="item.to"
      ) {{ item.title }}
    RouterLink.header__menu-logo(:to="{ name: 'home' }")
    .header__menu-right
      RouterLink.header__menu-item(
        v-for="item in right"
        :key="item.title"
        :to="item.to"
      ) {{ item.title }}
      .header__menu-item.header__menu-item_feedback(v-tap="showModal")
        | {{ $t('header.feedback') }}
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'HeaderTopMenu',
  computed: {
    ...mapState('main', ['menu']),
    left: vm => vm.menu.filter(el => el.title).slice(0, 4),
    right: vm => vm.menu.filter(el => el.title).slice(4)
  },
  methods: {
    showModal () {
      this.$modal.show('ModalFeedback')
    }
  }
}
</script>
