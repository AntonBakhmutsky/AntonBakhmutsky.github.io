window.addEventListener('load', () => {
  if (!document.querySelector('.main-desc__video')) {
    return false
  } else {
    const video = document.querySelector('.main-desc__video video')
    const videoContainer = document.querySelector('.main-desc__video')

    const toggleVideo = () => {
      if (!videoContainer.classList.contains('active')) {
        console.log(true)
        videoContainer.classList.add('active')
        video.play()
      } else {
        videoContainer.classList.remove('active')
        video.pause()
      }
    }

    videoContainer.addEventListener('click', toggleVideo)
  }
})
