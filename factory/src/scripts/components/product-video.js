window.addEventListener('load', () => {
  if (!document.querySelector('.product__video')) {
    return false
  } else {
    const videos = document.querySelectorAll('.product__video video')
    const videoButtons = document.querySelectorAll('.product__video-btn')

    const toggleVideo = (e) => {
      console.log(e)
      const videoContainer = e.target.closest('.product__video')
      const video = videoContainer.querySelector('video')

      const stopVideo = () => {
        videoContainer.classList.remove('playing')
        video.pause()
      }

      if (videoContainer.classList.contains('playing')) {
        stopVideo()
      } else {
        videoContainer.classList.add('playing')
        video.play()
      }

      video.addEventListener('pause', () => stopVideo())
    }

    videoButtons.forEach(el => el.addEventListener('click', toggleVideo))
    videos.forEach(el => el.addEventListener('click', toggleVideo))
  }
})
