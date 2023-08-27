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

  // якоря
  if (document.querySelector('a[href^="#"]')) {
    const anchors = document.querySelectorAll('a[href^="#"]')

    function goToAnchor(e) {
      e.preventDefault()
      if (e.target.closest('.price-anchors-mobile')) {
        document.querySelectorAll('.price-anchors-mobile a').forEach(el => el.classList.remove('active'))
        this.classList.add('active')
      }
      const el = document.querySelector(`#${this.href.split('#').at(-1)}`)
      const y = el.getBoundingClientRect().top
      window.scrollBy({
        top: y - document.querySelector('.header').offsetHeight - 15
      })
    }

    anchors.forEach(el => el.addEventListener('click', goToAnchor))
  }
})
