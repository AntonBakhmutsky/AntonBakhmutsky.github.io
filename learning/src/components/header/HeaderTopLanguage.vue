<template lang="pug">
  .header__language(
    :class="{ 'header__language_open': active }"
    v-tap="toggle"
    v-tap-outside="hide"
  )
    .header__language-arrow
    .header__language-link(
      v-for="lang in sortLanguages"
      :key="lang.locale"
      v-tap="() => changeLocale(lang.locale)"
    )
      .header__language-link-image
        img(:src="require(`@/assets/img/header/lang/${lang.locale}.png`)" alt="")
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
    sortLanguages: vm => vm.languages.sort(a => a.locale === vm.$i18n.locale ? -1 : 1)
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
