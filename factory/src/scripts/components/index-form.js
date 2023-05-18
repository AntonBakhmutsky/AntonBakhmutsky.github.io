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

    function applyStyles(input) {
      // Удаляем все стили классов перед применением новых стилей
      input.classList.remove('default-input');
      input.classList.remove('filled-input');
      input.classList.remove('active-input');

      if (input.value !== '') {
        // Если введено значение, применяем стили для введенных input
        input.classList.add('filled-input');
      } else if (input === document.activeElement) {
        // Если input активен (пользователь вводит значение), применяем стили для активного input
        input.classList.add('active-input');
      } else {
        // В остальных случаях применяем стили для обычных input
        input.classList.add('default-input');
      }
    }

}});
