import initInputs from '../helpers/inputs'

window.addEventListener('load', () => {
  if (document.querySelector('.form-input')) {
    console.log(true)
    initInputs(document.querySelectorAll('.form-input'))
  }
})
