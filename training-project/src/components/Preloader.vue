<template lang="pug">
  .preloder(:class="{'preloader-hidden': !active}")
    img(src="@/assets/img/global/preloader.gif" alt="")
</template>

<script>
export default {
  name: 'Preloader',
  data: () => ({
    active: true
  }),
  watch: {
    active (value) {
      const body = document.querySelector('body')
      body.classList.toggle('preload', value)
    }
  },
  mounted () {
    this.$nextTick(() => {
      this.active = false
    })
  }
}
</script>
