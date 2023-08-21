window.addEventListener('load', () => {
  const btns = document.querySelectorAll('[data-modal]')
  const modals = document.querySelectorAll('.modal')

  function openModal() {
    document.querySelector(`.${this.dataset.modal}`).classList.add('active')
    document.body.classList.add('body_fix')
  }

  function closeModal(e) {
    e.stopPropagation()
    if (e.target.closest('.modal__close') || e.target.classList.contains('active') && e.target.classList.contains('modal')) {
      modals.forEach(el => el.classList.remove('active'))
      document.body.classList.remove('body_fix')
    }
  }

  btns.forEach(el => el.addEventListener('click', openModal))
  modals.forEach(el => el.addEventListener('click', closeModal))
})
