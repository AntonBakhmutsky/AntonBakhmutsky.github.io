window.addEventListener('click', () => {
  if (document.querySelector('.modal')) {
    return false
  } else {
    const body = document.querySelector('body')
    const modalBtn = document.querySelectorAll('[data-modal]')
    const modals = document.querySelectorAll('.modal')

    const toggleModal = function (id) {
      const modal = document.querySelector(`.modal__${id}`)

      if (!modal) {
        return false
      }

      modal.classList.toggle('active')
      body.classList.toggle('body_fix')
    }

    const closeModals = function (e) {
      const modals = document.querySelectorAll(`.modal`)

      if (e.target.closest('.modal__close') || e.target.classList.contains('active')) {
        modals.forEach(modal => {
          modal.classList.remove('active')
        })
        document.body.classList.remove('body_fix')
      }

      body.classList.remove('body_fix')
    }

    modals.forEach(el => {
      el.addEventListener('click', closeModals)
    })

    modalBtn.forEach(btn => {
      btn.addEventListener('click', (e) => {
        e.stopPropagation()
        toggleModal(btn.dataset.modal)
      })
    })

    body.addEventListener('click', (e) => {
      if (e.target.closest('.modal__wrapper')) {
        return false
      } else if (!e.target.closest('.header__menu-search')) {
        closeModals()
      }
    })
  }
})
