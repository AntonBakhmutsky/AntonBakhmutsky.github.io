window.addEventListener('load', () => {
  if (!document.querySelector('.main-desc__video')) {
    return false
  } else {
    const video = document.querySelector('.main-desc__video video')
    const videoContainer = document.querySelector('.main-desc__video')
    const videoBtn = document.querySelector('.main-desc__video button')

    const toggleVideo = () => {
      if (!videoContainer.classList.contains('active')) {
        console.log(true)
        videoContainer.classList.add('active')
        video.play()
      } else {
        videoContainer.classList.remove('active')
      }
    }

    videoContainer.addEventListener('click', toggleVideo)
  }
})
