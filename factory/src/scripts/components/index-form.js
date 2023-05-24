window.addEventListener('load', () => {
  if (document.querySelector('.index-form')) {
    const fileInput = document.getElementById('indexFormFileInput');
    const fileLabel = document.getElementById('indexFormFileLabel');
    const fileDetails = document.getElementById('indexFormFileDetails');
    const fileName = document.getElementById('indexFormFileName');
    const deleteFileBtn = document.getElementById('indexFormFileDeleteBtn');

    fileDetails.style.display = 'none';

    fileInput.addEventListener('change', function() {
      if (fileInput.files.length > 0) {
        const selectedFile = fileInput.files[0];
        fileLabel.style.display = 'none';
        fileDetails.style.display = 'flex';
        fileName.textContent = selectedFile.name;
      } else {
        fileLabel.style.display = 'flex';
        fileDetails.style.display = 'none';
        fileName.textContent = '';
      }
    });

    deleteFileBtn.addEventListener('click', function () {
      fileInput.value = '';
      fileLabel.style.display = 'flex';
      fileDetails.style.display = 'none';
      fileName.textContent = '';
    })



    const submitBtn = document.querySelector('.index-form-content-btn')
    const modalSent = document.querySelector('.sent-modal')
    const nameInput = document.getElementById("indexFormInputName");
    const phoneInput = document.getElementById("indexFormInputTel");
    const emailInput = document.getElementById("indexFormInputEmail");
    const form = document.getElementById('indexForm')
    const btnCloseModal = document.getElementById('sentModalClose')

    function closeModal() {
      console.log('hf')
      modalSent.style.display = 'none';
    }

    btnCloseModal.addEventListener('click', closeModal)

    modalSent.addEventListener('click', function(e) {
      if (e.target === modalSent) {
        closeModal();
      }
    });

    function validateEmail () {
      const emailV = emailInput.value;
      const emailPattern = /\S+@\S+\.\S+/; // используем проверку наличия символа @ и точки после него

      return emailPattern.test(emailV);
    }
    function showModal () {
      if (nameInput.value === "") {
        console.log("Введите имя");
      } else if (phoneInput.value === "") {
        console.log("Введите номер телефона");
      }  else if (emailInput.value === "") {
        console.log("Введите email");
      } else if (!validateEmail()) {
        console.log("Введён некорректный email");
      } else {
        modalSent.style.display = 'flex';
        form.reset();
      }
    }

    submitBtn.addEventListener('click', showModal)





}});
