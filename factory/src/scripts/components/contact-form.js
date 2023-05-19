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

    const inputFile = document.getElementById('formFileInput');
    const labelFile = document.getElementById('formFileLabel');
    const detailsFile = document.getElementById('formFileDetails');
    const nameFile = document.getElementById('formFileName');
    const fileBtnDelete = document.getElementById('formFileDeleteBtn');

    detailsFile.style.display = 'none';

    inputFile.addEventListener('change', function() {
      if (inputFile.files.length > 0) {
        const selectedFile = inputFile.files[0];
        labelFile.style.display = 'none';
        detailsFile.style.display = 'flex';
        nameFile.textContent = selectedFile.name;
      } else {
        labelFile.style.display = 'flex';
        detailsFile.style.display = 'none';
        nameFile.textContent = '';
      }
    });

    fileBtnDelete.addEventListener('click', function () {
      inputFile.value = '';
      labelFile.style.display = 'flex';
      detailsFile.style.display = 'none';
      nameFile.textContent = '';
    })
  }




})
