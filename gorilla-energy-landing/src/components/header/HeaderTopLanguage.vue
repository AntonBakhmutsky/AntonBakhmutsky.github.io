<template lang="pug">
  .header__language(
    :class="{ 'header__language_open': active }"
    v-tap="toggle"
    v-tap-outside="hide"
  )
    .header__language-arrow
    .header__language-link(
      :class="`header__language-link_${lang.title}`"
      v-for="lang in availableLanguages"
      :key="lang.locale"
      v-tap="() => changeLocale(lang.locale)"
    )
      .header__language-link-lang {{ lang.title }}
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'HeaderTopLanguage',
  data: () => ({
    active: false
  }),
  computed: {
    ...mapState('main', ['languages']),
    availableLanguages: vm => vm.languages.sort(item => item.locale === vm.$i18n.locale ? -1 : 1)
  },
  methods: {
    changeLocale (locale) {
      if (this.$i18n.locale !== locale) {
        localStorage.setItem('locale', locale)
        location.reload()
      }
    },
    hide () {
      this.active = false
    },
    toggle () {
      this.active = !this.active
    }
  }
}
</script>
