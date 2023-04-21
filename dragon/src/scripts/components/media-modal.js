window.addEventListener('load', () => {
  if (!document.querySelector('.media-modal')) {
    return null
  } else {
    const photos = document.querySelectorAll('.media__photo')
    const videos = document.querySelectorAll('.media__video')
    const modal = document.querySelector('.media-modal')
    const modalClose = document.querySelector('.media-modal__close')
    const screen = modal.querySelector('.media-modal__screen')

    const toggleModal = (e) => {
      if (!modal.classList.contains('active')) {
        const content = e.currentTarget.cloneNode(true)
        screen.innerHTML = ''
        screen.insertAdjacentElement('afterbegin', content)
        modal.classList.add('active')
        document.body.classList.add('body_fix')
      } else {
        document.body.classList.remove('body_fix')
        modal.classList.remove('active')
        screen.innerHTML = ''
      }
    }

    const handleModalVideo = (e) => {
      const video = e.target.closest('.media__video').querySelector('video')
      if (video) {
        if (e.target.classList.contains('media__video-overlay')) {
          e.target.closest('.media__video').classList.add('active')
          video.play()
        } else {
          e.target.closest('.media__video').classList.remove('active')
          video.pause()
        }
      }
    }

    photos.forEach(el => el.addEventListener('click', toggleModal))
    videos.forEach(el => el.addEventListener('click', toggleModal))
    modalClose.addEventListener('click', toggleModal)
    modal.addEventListener('click', handleModalVideo)
  }
});
