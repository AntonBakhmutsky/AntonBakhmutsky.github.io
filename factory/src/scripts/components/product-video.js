window.addEventListener('load', () => {
  if (!document.querySelector('.product__video')) {
    return false
  } else {
    const videos = document.querySelectorAll('.product__video video')
    const videoButtons = document.querySelectorAll('.product__video-btn')

    const toggleVideo = (e) => {
      const videoContainer = e.target.closest('.product__video')
      const video = videoContainer.querySelector('video')

      if (videoContainer.classList.contains('playing')) {
        videoContainer.classList.remove('playing')
        video.pause()
      } else {
        videoContainer.classList.add('playing')
        video.play()
      }
    }

    videoButtons.forEach(el => el.addEventListener('click', toggleVideo))
    videos.forEach(el => el.addEventListener('click', toggleVideo))
  }
})
