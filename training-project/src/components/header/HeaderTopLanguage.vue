<template lang="pug">
  .header__language(
    :class="{ 'header__language_open': active }"
    @click="active = !active"
  )
    .header__language-arrow
    a.header__language-link(
      v-for="lang in sortLanguages"
      :key="lang.locale"
      @click.prevent="changeLocal(lang.locale)"
      href="javascript:"
    )
      .header__language-link-image
        img(:src="lang.img" alt="")
      .header__language-link-lang {{ lang.title }}
</template>

<script>
export default {
  name: 'HeaderTopLanguage',
  data: () => ({
    active: false,
    languages: [
      { locale: 'en', title: 'eng', img: require('@/assets/img/header/lang/eng.png') },
      { locale: 'ru', title: 'рус', img: require('@/assets/img/header/lang/rus.png') },
      { locale: 'kz', title: 'каз', img: require('@/assets/img/header/lang/kaz.png') }
    ]
  }),
  computed: {
    sortLanguages: vm => vm.languages.sort(a => a.locale === vm.$i18n.locale ? -1 : 1)
  },
  methods: {
    changeLocal (locale) {
      if (this.$i18n.locale !== locale) {
        localStorage.setItem('locale', locale)
        location.reload()
      }
    }
  }
}
</script>
