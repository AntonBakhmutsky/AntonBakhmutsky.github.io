window.addEventListener('load', () => {
  if (!document.querySelector('.main-desc__video')) {
    return false
  } else {
    const video = document.querySelector('.main-desc__video video')
    const videoContainer = document.querySelector('.main-desc__video')

    const toggleVideo = () => {
      videoContainer.classList.add('active')
      video.play()
    }

    video.addEventListener('click', toggleVideo)
    video.addEventListener('touchend', toggleVideo)
  }
})
