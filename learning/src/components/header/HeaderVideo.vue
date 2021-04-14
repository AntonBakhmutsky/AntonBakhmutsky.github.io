<template lang="pug">
  .header__video
    video(
      muted
      autoplay
      loop
      poster="@/assets/video/header_video_poster.jpg"
    )
      source(src="@/assets/video/header_video.webm" type="video/webm")
      source(src="@/assets/video/header_video.mp4" type="video/mp4")
</template>

<script>
export default {
  name: 'HeaderVideo'
}
</script>
