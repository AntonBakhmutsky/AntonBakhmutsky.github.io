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
    const searchForm = document.querySelector(".application_search");
    const checkboxContainer = document.querySelectorAll(".application_search_form-disclosed_checkboxes__item");
    let isShortFormVisible = true;



    checkboxContainer.forEach(function(checkboxContainer) {
      const appCheckbox = checkboxContainer.querySelector('.application_search_form-disclosed_checkboxes__item__checkbox');
      const appSvg = checkboxContainer.querySelector('.application_search_form-disclosed_checkboxes__item__img');

      checkboxContainer.addEventListener('click', function() {
        appCheckbox.checked = !appCheckbox.checked;
        appSvg.innerHTML = `<svg width=\"8\" height=\"8\" viewBox=\"0 0 8 8\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">\n" +
          "<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M4.82498 4L7.32923 1.49575C7.55731 1.26767 7.55731 0.899001 7.32923 0.670918C7.10115 0.442834 6.73248 0.442834 6.5044 0.670918L4.00015 3.17517L1.4959 0.670918C1.26781 0.442834 0.899146 0.442834 0.671063 0.670918C0.442979 0.899001 0.442979 1.26767 0.671063 1.49575L3.17531 4L0.671063 6.50425C0.442979 6.73233 0.442979 7.101 0.671063 7.32908C0.784813 7.44283 0.934146 7.5 1.08348 7.5C1.23281 7.5 1.38215 7.44283 1.4959 7.32908L4.00015 4.82483L6.5044 7.32908C6.61815 7.44283 6.76748 7.5 6.91681 7.5C7.06615 7.5 7.21548 7.44283 7.32923 7.32908C7.55731 7.101 7.55731 6.73233 7.32923 6.50425L4.82498 4Z\" fill=\"white\"/>\n" +
          "</svg>`
        checkboxContainer.classList.toggle('selected');
        checkboxContainer.querySelector('label').classList.toggle('select-checkbox');
      });
    });



    applicationToggle.addEventListener("click", ()=>{

      if (!isShortFormVisible) {
        shortForm.style.display = 'block';
        longForm.style.display = 'none';
        btnReset.style.display = 'none';
        longFormTitle.style.display = 'none';
        isShortFormVisible = true;
        searchForm.classList.toggle('application_search-long-type');
      } else {
        // Если элемент 1 уже показан, скрываем его и показываем элемент 2
        shortForm.style.display = 'none';
        longForm.style.display = 'block';
        btnReset.style.display = 'flex';
        longFormTitle.style.display = 'block';
        isShortFormVisible = false;
        searchForm.classList.toggle('application_search-long-type');
      }
    });
  }

});
