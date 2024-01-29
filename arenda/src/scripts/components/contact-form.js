window.addEventListener('load', () => {

  if (document.querySelector('.contact-form')) {

    // form inputs
    const contactForm = document.querySelector('.contact-form')

    // toggle form
    const contactFormBtn = document.querySelector('.contact-form__btn')
    const contactFormClose = contactForm.querySelector('.contact-form__close')
    const contactFormOverlay = document.querySelector('.contact-form__overlay')
    const contactFormSwitcher = document.querySelector('.contact-form__btns')
    const contactFormSwitcherBtns = [...document.querySelectorAll('.contact-form__btns button')]
    const contactFormItems = [...document.querySelectorAll('.contact-form form')]

    const toggleContactForm = () => {
      contactForm.classList.toggle('active')
      contactFormBtn.classList.toggle('disabled')
      contactFormOverlay.classList.toggle('active')
      document.body.classList.toggle('body_fix')
    }

    function toggleFormContent(e) {
      if (e.target.closest('button') && !e.target.closest('button').classList.contains('active')) {
        const currentButton = e.target.closest('button')
        const id = currentButton.dataset.id
        const currentForm = contactFormItems.find(el => el.dataset.id === id)
        console.log(currentForm)

        contactFormSwitcherBtns.forEach(el => el.classList.remove('active'))
        contactFormItems.forEach(el => el.classList.remove('active'))

        currentButton.classList.add('active')
        currentForm.classList.add('active')
      }
    }

    contactFormBtn.addEventListener('click', toggleContactForm)
    contactFormClose.addEventListener('click', toggleContactForm)
    contactFormOverlay.addEventListener('click', toggleContactForm)
    contactFormSwitcher.addEventListener('click', toggleFormContent)



    // input file
    // const inputFile = contactForm.querySelector('.contact-form__file input')
    // const inputFileLabel = inputFile.nextElementSibling
    // const labelValue = inputFileLabel.querySelector('.contact-form__file-txt')
    //
    // inputFile.addEventListener('change', function (event) {
    //   let countFiles
    //   if (this.files && this.files.length >= 1) {
    //     countFiles = this.files.length
    //   }
    //   if (countFiles) {
    //     labelValue.innerText = 'Выбрано файлов: ' + countFiles
    //   } else {
    //     labelValue.innerText = 'Прикрепить файл'
    //   }
    // })

  }
})
