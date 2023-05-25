window.addEventListener('load', () => {
  if (!document.querySelector('.call-modal')) {
    return null
  } else {
    const modal = document.querySelector('.call-modal')
    const modalBtns = document.querySelectorAll('.call-modal__btn')

    const openModal = () => {
      modal.classList.add('active')
      document.body.classList.add('body_fix')
    }

    const closeModal = (e) => {
      const target = e.target
      if (target.closest('.call-modal__close') || target.classList.contains('call-modal')) {
        modal.classList.remove('active')
        document.body.classList.remove('body_fix')
        forma.reset();
      }
    }


    modalBtns.forEach(el => el.addEventListener('click', openModal))
    modal.addEventListener('click', closeModal)

    const subBtn = document.querySelector('.call-modal__submit')
    const modalSucc = document.querySelector('.sent-modal')
    const nameInput = document.getElementById("modal-name");
    const phoneInput = document.getElementById("modal-phone");
    const forma = document.querySelector('.call-modal__form')
    const btnClsModal = document.querySelector('.sent-modal_close')

    function closeMod() {
      modalSucc.style.display = 'none';
    }

    btnClsModal.addEventListener('click', closeMod)

    modalSucc.addEventListener('click', function(e) {
      if (e.target === modalSucc && !modalSucc.contains(e.target)) {
        modalSucc.style.display = 'none';
      }
    });

    document.addEventListener('click', (e) => {
      if(e.target === modalSucc) {
        modalSucc.style.display = 'none'
      }
    });

    function showMod (event) {
      event.preventDefault();
      if (nameInput.value === "") {
        return null
      } else if (phoneInput.value === "") {
        return null
      } else {
        modal.classList.remove('active')
        document.body.classList.remove('body_fix')
        modalSucc.style.display = 'flex';
        forma.reset();
      }

    }

    subBtn.addEventListener('click', showMod)

  }
})
