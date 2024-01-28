window.addEventListener('load', () => {
  if (!document.querySelector('.video')) {
    return false
  } else {
    const videos = document.querySelectorAll('.video video')
    const videoButtons = document.querySelectorAll('.video__btn')

    const toggleVideo = (e) => {
      const videoContainer = e.target.closest('.video')
      const video = videoContainer.querySelector('video')

      videoContainer.classList.add('playing')
      video.play()
    }

    videoButtons.forEach(el => el.addEventListener('click', toggleVideo))
    videos.forEach(el => el.addEventListener('click', toggleVideo))
  }
})
