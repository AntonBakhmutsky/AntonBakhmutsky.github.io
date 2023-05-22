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


    const btnLeaveOrder = document.getElementById('btnLeaveOrder');
    const btnRequestCall = document.getElementById('btnRequestCall');
    const formLeaveOrder = document.getElementById('formLeaveOrder');
    const formRequestCall = document.getElementById('formRequestCall');

    btnLeaveOrder.addEventListener("click", () => {
      formLeaveOrder.style.display = "flex";
      formRequestCall.style.display = "none";
      btnLeaveOrder.classList.add("contact-form-btns__order-btn");
      btnRequestCall.classList.remove("contact-form-btns__order-btn");
    });

    btnRequestCall.addEventListener("click", () => {
      formRequestCall.style.display = "flex";
      formLeaveOrder.style.display = "none";
      btnRequestCall.classList.add("contact-form-btns__order-btn");
      btnLeaveOrder.classList.remove("contact-form-btns__order-btn");
    });

    btnLeaveOrder.click();
    btnLeaveOrder.classList.add("active");




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
