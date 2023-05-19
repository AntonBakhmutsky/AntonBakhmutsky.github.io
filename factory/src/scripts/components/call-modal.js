window.addEventListener('load', () => {
  if (!document.querySelector('.call-modal')) {
    return null
  } else {
    const modal = document.querySelector('.call-modal')
    const modalBtns = document.querySelectorAll('.call-modal__btn')
    const modalBtnForm = document.getElementById('btnRequestCall')
    const contactForm = document.querySelector('.contact-form')
    const contactFormBtn = document.querySelector('.contact-form-btn')
    const contactFormOverlay = document.querySelector('.contact-form__overlay')

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

    const openModalFromForm = () => {
      modal.classList.add('active')
      document.body.classList.add('body_fix')
      contactForm.classList.toggle('active')
      contactFormBtn.classList.toggle('disabled')
      contactFormOverlay.classList.toggle('active')
    }


    modalBtns.forEach(el => el.addEventListener('click', openModal))
    modalBtnForm.addEventListener('click', openModalFromForm)
    modal.addEventListener('click', closeModal)
  }
})
