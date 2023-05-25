window.addEventListener('load', () => {

  if (!document.querySelector('.contacts-form')) {
    return false
  } else {

    const btnS = document.querySelector('.contacts-form__submit');
    const formContact = document.getElementById('contactsForm');
    const modalRes = document.querySelector('.sent-modal')
    const nameInputC = document.getElementById("contactsFormName");
    const phoneInputC = document.getElementById("contactsFormPhone");
    const checkbox = document.getElementById("policy");
    const btnClsModal = document.getElementById('sentModalClose')

    function closeModal() {
      modalRes.style.display = 'none';
    }

    btnClsModal.addEventListener('click', closeModal)

    modalRes.addEventListener('click', function(e) {
      if (e.target === modalRes && !modalRes.contains(e.target)) {
        closeModal();
      }
    });

    document.addEventListener('click', (e) => {
      if(e.target === modalRes) {
        modalRes.style.display = 'none'
      }
    });

    btnS.addEventListener('click', function (event){
      event.preventDefault();
      if (nameInputC.value === "") {
        return null
      } else if (phoneInputC.value === "") {
        return null
      }   else if (!checkbox.checked) {
        return null
      } else {
        modalRes.style.display = 'flex';
        formContact.reset();
      }
    })

  }
})
