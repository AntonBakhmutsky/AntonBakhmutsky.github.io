//PAGE APPLICATION
window.addEventListener('load', () => {
  if (!document.querySelector('.one-application')) {
    return null
  } else {
    const modal = document.getElementById('oneApplicationModal');
    const btnOpenModal = document.getElementById('btnCompleteManually');


    function openModal() {
      modal.style.display = 'flex';
    }
    function closeModal() {
      modal.style.display = 'none';
    }

    btnOpenModal.addEventListener('click', openModal);

    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeModal();
      }
    });


  }

});
