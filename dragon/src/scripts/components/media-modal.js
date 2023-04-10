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
        const content = e.currentTarget.children[0].cloneNode(true)
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

    photos.forEach(el => el.addEventListener('click', toggleModal))
    videos.forEach(el => el.addEventListener('click', toggleModal))
    modalClose.addEventListener('click', toggleModal)
  }
});
