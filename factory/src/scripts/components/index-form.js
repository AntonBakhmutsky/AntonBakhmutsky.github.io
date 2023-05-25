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
      modalSent.style.display = 'none';
    }

    btnCloseModal.addEventListener('click', closeModal)

    modalSent.addEventListener('click', function(e) {
      if (e.target === modalSent && !modalSent.contains(e.target)) {
        modalSent.style.display = 'none';
      }
    });

    document.addEventListener('click', (e) => {
      if(e.target === modalSent) {
        modalSent.style.display = 'none'
      }
    });

    function validateEmail () {
      const emailV = emailInput.value;
      const emailPattern = /\S+@\S+\.\S+/; // используем проверку наличия символа @ и точки после него

      return emailPattern.test(emailV);
    }
    function showModal () {
      if (nameInput.value === "") {
        return null
      } else if (phoneInput.value === "") {
        return null
      }  else if (emailInput.value === "") {
        return null
      } else if (!validateEmail()) {
        return null
      } else {
        modalSent.style.display = 'flex';
        form.reset();

        fileInput.value = '';
        fileLabel.style.display = 'flex';
        fileDetails.style.display = 'none';
        fileName.textContent = '';

        nameInput.addEventListener('invalid', function(event) {
          event.preventDefault();
          nameInput.setCustomValidity('');
        });

        phoneInput.addEventListener('invalid', function(event) {
          event.preventDefault();
          phoneInput.setCustomValidity('');
        });

        emailInput.addEventListener('invalid', function(event) {
          event.preventDefault();
          emailInput.setCustomValidity('');
        });

      }
    }

    submitBtn.addEventListener('click', showModal)





}});
