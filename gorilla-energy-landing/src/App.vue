<template lang="pug">
  RouterView
</template>

<script>
import 'nprogress/nprogress.css'
import '@/styles/app.sass'
import axios from 'axios'
import i18n from '@/plugins/i18n'
import { mapState, mapActions, mapMutations } from 'vuex'

export default {
  name: 'App',
  async mounted () {
    if (await this.setCountry()) {
      return
    }

    if (this.setLanguage()) {
      return
    }

    this.$nextTick(() => {
      this.preload()
      this.vh()
      this.bodyModifier()
    })
  },
  computed: {
    ...mapState('main', ['languages']),
    ...mapState('siteVersions', {
      countries: 'items',
      currentCountry: 'item'
    })
  },
  methods: {
    ...mapActions('siteVersions', {
      fetchCountries: 'fetch'
    }),
    ...mapMutations('siteVersions', {
      setCurrentCountry: 'SET_ITEM'
    }),
    ...mapMutations('main', {
      setLanguages: 'SET_LANGUAGES'
    }),
    async setCountry () {
      await this.fetchCountries()

      const currentCountry = localStorage.getItem('country')
      const existCountry = this.countries.find(country => country.id === +currentCountry)

      if (existCountry) {
        this.setCurrentCountry(existCountry)
      } else {
        let countryCode = 'global'

        try {
          const { data } = await axios.get(process.env.VUE_APP_GEO_IP_URL)

          switch (data.country) {
            case 'RU':
              countryCode = 'ru'
              break
            case 'KZ':
              countryCode = 'kz'
              break
            case 'UA':
              countryCode = 'ua'
              break
          }
        } catch (error) {}

        localStorage.setItem(
          'country',
          this.countries.find(item => item.code === countryCode)?.id || this.countries[0]?.id
        )

        location.reload()

        return true
      }
    },
    setLanguage () {
      this.setLanguages(this.currentCountry.locales)

      const locale = localStorage.getItem('locale')
      const existLocale = this.languages.find(item => item.locale === locale)

      if (!existLocale) {
        localStorage.setItem('locale', this.languages[0].locale)
        location.reload()

        return true
      }
    },
    preload () {
      const body = document.querySelector('body')
      const preloader = document.querySelector('.preloader')

      preloader.classList.add('preloader-hidden')
      body.classList.remove('preload')
    },
    vh () {
      let lastWidth = window.innerWidth

      const listener = () => {
        let vh = window.innerHeight * 0.01
        document.documentElement.style.setProperty('--vh', `${vh}px`)
      }

      window.addEventListener('resize', () => {
        if (lastWidth !== window.innerWidth) {
          lastWidth = window.innerWidth
          listener()
        }
      })

      listener()
    },
    bodyModifier () {
      document.querySelector('body').classList.add(`locale-${i18n.locale}`)
    }
  }
}
</script>
