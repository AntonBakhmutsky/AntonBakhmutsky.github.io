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
    const inputFile = contactForm.querySelector('.contact-form__file input')
    const filesContainer = contactForm.querySelector('.contact-form__file-container')

    function getFileItemTemplate(name, id) {
      const item = document.createElement('div')
      item.classList.add('contact-form__file-item')
      item.dataset.id = id
      const fileName = document.createElement('div')
      fileName.classList.add('contact-form__file-item-name')
      fileName.textContent = name
      item.insertAdjacentElement('beforeend', fileName)
      const fileRemove = document.createElement('div')
      item.insertAdjacentElement('beforeend', fileRemove)

      return item
    }

    function toggleDownloadFiles() {
      filesContainer.innerHTML = ''
      const files = this.files
      for (let key in files) {
        if (+key === 0 || +key ) {
          const item = getFileItemTemplate(files[key].name, key)
          filesContainer.insertAdjacentElement('beforeend', item)
          filesContainer.classList.remove('disabled')
        }
      }
    }

    function removeDownloadFile() {
      delete inputFile.files[+this.parentElement.dataset.id]
      console.log(inputFile.files)
      this.parentElement.remove()
    }

    inputFile.addEventListener('change', toggleDownloadFiles)
  }
})
