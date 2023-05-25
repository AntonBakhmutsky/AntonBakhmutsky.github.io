window.addEventListener('load', () => {
  if (!document.querySelector('.pagination')) {
    return null
  } else {
    const modal = document.getElementById('helpModal');
    const btnOpenModal = document.getElementById('paginationQuestionBtn');

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
