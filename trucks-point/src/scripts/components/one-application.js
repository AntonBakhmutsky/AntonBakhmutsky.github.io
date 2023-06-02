//PAGE APPLICATION
window.addEventListener('load', () => {
  if (!document.querySelector('.one-application')) {
    return null
  } else {
    const modal = document.getElementById('oneApplicationModal');
    const btnOpenModal = document.getElementById('btnCompleteManually');
    const closeBtn = document.getElementById('oneApplicationCloseBtn');
    const modalForm = document.getElementById('oneApplicationModalForm');


    function openModal() {
      modal.style.display = 'flex';
    }
    function closeModal() {
      modal.style.display = 'none';
      modalForm.reset();
    }

    btnOpenModal.addEventListener('click', openModal);

    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeModal();
      }
    });

    closeBtn.addEventListener('click', closeModal);

  }

});
