window.addEventListener('load', () => {

  if (!document.querySelector('.contact-form')) {
    return false
  } else {

    // form inputs
    const contactForm = document.querySelector('.contact-form')

    // toggle form
    const contactFormBtn = document.querySelector('.contact-form-btn')
    const contactFormClose = contactForm.querySelector('.contact-form__close')
    const contactFormOverlay = document.querySelector('.contact-form__overlay')

    const toggleContactForm = () => {
      contactForm.classList.toggle('active')
      contactFormBtn.classList.toggle('disabled')
      contactFormOverlay.classList.toggle('active')
      document.body.classList.toggle('body_fix')
    }

    contactFormBtn.addEventListener('click', toggleContactForm)
    contactFormClose.addEventListener('click', toggleContactForm)
    contactFormOverlay.addEventListener('click', toggleContactForm)

    // input file
    const inputFile = contactForm.querySelector('.contact-form__file input')
    const inputFileLabel = inputFile.nextElementSibling
    const labelValue = inputFileLabel.querySelector('.contact-form__file-txt')

    inputFile.addEventListener('change', function (event) {
      let countFiles
      if (this.files && this.files.length >= 1) {
        countFiles = this.files.length
      }
      if (countFiles) {
        labelValue.innerText = 'Выбрано файлов: ' + countFiles
      } else {
        labelValue.innerText = 'Прикрепить файл'
      }
    })
  }
})
