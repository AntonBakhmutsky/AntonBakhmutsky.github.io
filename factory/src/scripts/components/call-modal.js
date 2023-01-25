window.addEventListener('load', () => {
  if (!document.querySelector('.call-modal')) {
    return null
  } else {
    const modal = document.querySelector('.call-modal')
    const modalBtns = document.querySelectorAll('.call-modal__btn')

    const openModal = () => {
      modal.classList.add('active')
      document.body.classList.add('body_fix')
    }

    const closeModal = (e) => {
      const target = e.target
      if (target.closest('.call-modal__close') || target.classList.contains('call-modal')) {
        modal.classList.remove('active')
        document.body.classList.remove('body_fix')
      }
    }

    modalBtns.forEach(el => el.addEventListener('click', openModal))
    modal.addEventListener('click', closeModal)
  }
})
