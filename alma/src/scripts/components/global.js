import initInputs from '../helpers/inputs';
import Inputmask from 'inputmask';

window.addEventListener('load', () => {
  if (document.querySelector('.form-input')) {
    initInputs(document.querySelectorAll('.form-input:not(.form-input_tel)'))
  }

  if (document.querySelector('.form-input_tel')) {
    document.querySelectorAll('.form-input_tel input').forEach(el => {
      Inputmask({'mask': '+7 (999) 999-99-99'}).mask(el)
    })
  }
})
