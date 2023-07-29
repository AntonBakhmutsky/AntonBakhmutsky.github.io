import initInputs from '@/scripts/helpers/inputs'
import PhoneMask from '@zoibana/phonemask'

window.addEventListener('load', () => {
  if (!document.querySelector('.main_vacancies')) {
    return false
  } else {
    if (document.querySelector('.vacancies-offer__items')) {
      const container = document.querySelector('.vacancies-offer__items')

      function toggleAccordion(e) {
        if (e.target.closest('.accordion__visible')) {
          const acc = e.target.closest('.accordion')
          const accHidden = acc.querySelector('.accordion__hidden')
          acc.classList.toggle('open')
          accHidden.hasAttribute('style') ?
            accHidden.removeAttribute('style') :
            accHidden.style.maxHeight = `${accHidden.scrollHeight}px`
        }
      }

      container.addEventListener('click', toggleAccordion)
    }

    if (document.querySelector('.form__input')) {
      initInputs(document.querySelectorAll('.form__input'))
    }

    if (document.querySelector('input[type="tel"]')) {
      const phoneInputs = document.querySelectorAll('.modal input[type="tel"]')
      phoneInputs.forEach(el => new PhoneMask(el))
    }

    if (document.querySelector('.form__file')) {
      const fileInput = document.querySelector('.modal input[type="file"]')
      const fileInputClear = document.querySelector('.modal .form__input-clear')

      function toggleFile(e) {
          const container = this.closest('.form__file')
          const currentValue = container.querySelector('span')
          const allowedExtensions = ['pdf', 'docx', 'doc', 'pptx']
          const extension = this.value.split('.').at(-1).trim().toLowerCase()

          if (this.files.length && allowedExtensions.includes(extension)) {

            container.classList.add('fill')
            currentValue.textContent = this.files[0].name

          } else {
            container.classList.add('error')
            setTimeout(() => {
              container.classList.remove('error')
            }, 5000)
          }
      }

      fileInput.addEventListener('change', toggleFile)
    }
  }
})
