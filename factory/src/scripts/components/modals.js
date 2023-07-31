window.addEventListener('click', (e) => {
  if (e.target.closest('[data-modal]') || e.target.closest('.modal')) {
    if (e.target.closest('[data-modal]')) {
      const btn = e.target.closest('[data-modal]')
      const modal = document.querySelector(`.${btn.dataset.modal}`)
      modal.classList.add('active')
      document.body.classList.add('body_fix')

      if (btn.classList.contains('accordion__link')) {
        const vacancyInput = modal.querySelector('input[name="vacancy"]')
        vacancyInput.value = e.target.closest('.accordion').querySelector('.accordion__title').textContent
        vacancyInput.nextElementSibling.classList.add('active')
        vacancyInput.setAttribute('readonly', 'true')
      }
    }
  }
})

window.addEventListener('load', () => {
  const modals = document.querySelectorAll('.modal')

  function closeModal(e) {
    if (e.target.closest('.modal__close') || e.target.classList.contains('active')) {
      this.classList.remove('active')
      document.body.classList.remove('body_fix')
    }
  }

  modals.forEach(el => el.addEventListener('click', closeModal))
})
