window.addEventListener('load', () => {
  // toggle modals
  const modals = document.querySelectorAll('.modal')
  const requestButtons = document.querySelectorAll('.header__request')
  const requestModal = document.querySelector('.modal-request')

  function toggleModal(e) {
    if (e.target.closest('.header__request')) {
      requestModal.classList.add('active')
      document.body.classList.add('body_fix')
    } else if (e.target.closest('.modal__close') || e.target.closest('.modal__submit') || e.target.classList.contains('active')) {
      modals.forEach(el => el.classList.remove('active'))
      document.body.classList.remove('body_fix')
    }
  }

  requestButtons.forEach(el => el.addEventListener('click', toggleModal))
  modals.forEach(el => el.addEventListener('click', toggleModal))

  // placeholder
  const inputs = document.querySelectorAll('.form__field-input')

  const risePlaceholder = (e) => {
    e.currentTarget.parentElement.classList.add('active')
    e.currentTarget.parentElement.classList.add('focus')
  }
  const lowerPlaceholder = (e) => {
    if (!e.currentTarget.value.trim()) {
      e.currentTarget.parentElement.classList.remove('active')
    }
    e.currentTarget.parentElement.classList.remove('focus')
  }

  inputs.forEach(el => el.addEventListener('focus', risePlaceholder))
  inputs.forEach(el => el.addEventListener('blur', lowerPlaceholder))
})
