<template lang="pug">
  main.main
    section.page-404
      .container
        h2.section-title.section-title_white
          span {{ $t('404.title') }}
</template>

<script>
export default {
  name: 'Error',
  computed: {
    classList: vm => vm.$attrs.bodyClass ? vm.$attrs.bodyClass : []
  },
  mounted () {
    document.querySelector('body').classList.add(...this.classList)
  },
  destroyed () {
    document.querySelector('body').classList.remove(...this.classList)
  },
  metaInfo: vm => ({
    title: vm.$t('404.title')
  })
}
</script>
