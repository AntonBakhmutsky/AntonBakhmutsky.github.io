//PAGE APPLICATION
window.addEventListener('load', () => {
  if (!document.querySelector('.one-application')) {
    return null
  } else {
    const modal = document.getElementById('oneApplicationModal');
    const btnOpenModal = document.getElementById('btnCompleteManually');
    const closeBtn = document.getElementById('oneApplicationCloseBtn');
    const modalForm = document.getElementById('oneApplicationModalForm');
    const pageOneAppInfo = document.getElementById('pageOneApplicationInfo');
    const btnCloseOneAppInfo = document.getElementById('btnCloseOneApplicationInfo');
    const btnShowInfo = document.getElementById('btnStatusOneAppInfo');
    const routeImg = document.querySelector('.route-map')
    const roteIconDescription = document.querySelector('.icon-description')


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

    btnCloseOneAppInfo.addEventListener('click', function () {
      pageOneAppInfo.style.display = 'none'
    })


    btnShowInfo.addEventListener('click', function () {
      pageOneAppInfo.classList.toggle('block')
    })

    routeImg.addEventListener('click', function () {
      roteIconDescription.classList.toggle('block')
    })



  }

});
