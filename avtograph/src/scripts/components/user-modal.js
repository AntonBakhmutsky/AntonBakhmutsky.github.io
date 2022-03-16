window.addEventListener('load', () => {
  const modalBtn = document.querySelector('.header__links-item_user')
  const modal = document.querySelector('.user-modal');
  const body = document.body;

  const showModal = () => {
    modal.classList.add('user-modal_active');
    body.classList.add('body-fixed');
  };

  const closeModal = (event) => {
    const target = event.target;
    if (target.closest('.user-modal__close') || target.classList.contains('user-modal')) {
      modal.classList.remove('user-modal_active');
      body.classList.remove('body-fixed');
    }
  };

  modalBtn.addEventListener('click', showModal)
  modal.addEventListener('click', closeModal)
})
