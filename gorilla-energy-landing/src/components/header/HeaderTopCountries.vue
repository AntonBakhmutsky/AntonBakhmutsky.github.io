<template lang="pug">
  .header__country(
    :class="{ 'header__country_open': active }"
    v-tap="toggle"
    v-tap-outside="hide"
  )
    .header__country-arrow
    .header__country-link(
      v-for="country in availableCountries"
      :key="country.id"
      v-tap="() => changeCountry(country.id)"
    )
      .header__country-link-lang {{ country.name }}
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'HeaderTopCountries',
  data: () => ({
    active: false
  }),
  computed: {
    ...mapState('siteVersions', {
      countries: state => state.items,
      currentCountry: state => state.item
    }),
    availableCountries: vm => vm.countries
      .filter(item => vm.currentCountry.code === 'ua' || item.code !== 'ua')
      .sort(country => country.id === vm.currentCountry.id ? -1 : 1)
  },
  methods: {
    changeCountry (id) {
      if (this.currentCountry.id !== id) {
        localStorage.setItem('country', id)
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
