<template lang="pug">
  .header__video
    video(
      :poster="poster"
      muted
      autoplay
      loop
      playsinline
    )
      source(
        :src="mp4"
        type="video/mp4"
      )
</template>

<script>
export default {
  name: 'HeaderVideo',
  computed: {
    poster: vm => window.innerWidth > 1024
      ? require(`@/assets/video/header-${vm.$i18n.locale}.jpg`)
      : require('@/assets/video/header-mobile.jpg'),
    mp4: vm => window.innerWidth > 1024
      ? require(`@/assets/video/header-${vm.$i18n.locale}.mp4`)
      : require(`@/assets/video/header-mobile.mp4`)
  }
}
</script>
