window.addEventListener('load', () => {
  if (!document.querySelector('.image-modal')) {
    return false
  } else {
    const modal = document.querySelector('.image-modal')
    const modalContainer = modal.querySelector('.image-modal__container')
    const images = document.querySelectorAll('.modal-img')

    const showModal = (e) => {
      const image = e.currentTarget.querySelector('img')
      modalContainer.insertAdjacentElement('afterbegin', image.cloneNode(true))
      modal.classList.add('active')
      document.body.classList.add('body_fix')
    }

    const closeModal = (e) => {
      e.stopPropagation()
      if (e.target.closest('.image-modal__close') || e.target.classList.contains('active')) {
        modal.classList.remove('active')
        document.body.classList.remove('body_fix')
        modalContainer.innerHTML = ''
      }
    }

    modal.addEventListener('click', closeModal)
    images.forEach(el => el.addEventListener('click', showModal))
  }
})
