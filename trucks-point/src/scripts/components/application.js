//PAGE APPLICATION
window.addEventListener('load', () => {
  if (!document.querySelector('.application')) {
    return null
  } else {
    const shortForm = document.querySelector(".application_search_form-closed");
    const longForm = document.querySelector(".application_search_form-disclosed");
    const applicationToggle = document.getElementById("applicationToggle");
    const btnReset = document.getElementById("application-btn-reset");
    const longFormTitle = document.querySelector(".application_search_toggle__title");
    let isShortFormVisible = false;

    applicationToggle.addEventListener("click", ()=>{
      if (!isShortFormVisible) {
        shortForm.style.display = 'block';
        longForm.style.display = 'none';
        btnReset.style.display = 'none';
        longFormTitle.style.display = 'none';
        isShortFormVisible = true;
      } else {
        // Если элемент 1 уже показан, скрываем его и показываем элемент 2
        shortForm.style.display = 'none';
        longForm.style.display = 'block';
        btnReset.style.display = 'block';
        longFormTitle.style.display = 'block';
        isShortFormVisible = false;
      }
    });
  }

});
