<template lang="pug">
  RouterView
</template>

<script>
import 'nprogress/nprogress.css'
import '@/styles/app.sass'
import axios from 'axios'
import i18n from '@/plugins/i18n'

export default {
  name: 'App',
  async mounted () {
    if (await this.geo()) {
      return
    }

    this.$nextTick(() => {
      this.preload()
      this.vh()
      this.bodyModifier()
    })
  },
  methods: {
    async geo () {
      if (localStorage.getItem('locale')) {
        return
      }

      try {
        const { data } = await axios.get(process.env.VUE_APP_GEO_IP_URL)

        let locale = ['RU', 'BY'].includes(data.country) ? 'ru' : 'en'

        localStorage.setItem('locale', locale)
        location.reload()

        return true
      } catch (error) {}
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
