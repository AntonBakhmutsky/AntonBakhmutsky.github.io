import initInputs from '../helpers/inputs'

window.addEventListener('load', () => {
  if (document.querySelector('.form-input')) {
    initInputs(document.querySelectorAll('.form-input'))
  }
})
