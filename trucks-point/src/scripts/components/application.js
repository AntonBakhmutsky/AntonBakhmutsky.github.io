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
    const buttonsContainer = document.querySelector(".application_search_form_buttons");
    const formHeaderContainer = document.querySelector(".application_search_toggle");
    const btnOpenListFromCityes = document.getElementById('btnAppFromCityes');
    const searchCityFromInput = document.querySelector('.application_search_form-disclosed_form-top_input')
    const searchCityToInput = document.querySelector('.application_search_form-disclosed_form-top_input-to')
    const disclosedListCityesFrom = document.querySelector('.application_search_form-disclosed_form-top_input_from-cityes')
    const btnOpenListToCityes = document.getElementById('btnAppToCityes');
    const disclosedListCityesTo = document.querySelector('.application_search_form-disclosed_form-top_input_to-cityes')
    let isShortFormVisible = true;
    let isListCityesFromVisible = true;
    let isListCityesToVisible = true;


    checkboxContainer.forEach(function(checkboxContainer) {
      const appCheckbox = checkboxContainer.querySelector('.application_search_form-disclosed_checkboxes__item__checkbox');
      const appSvg = checkboxContainer.querySelector('.application_search_form-disclosed_checkboxes__item__img');

      checkboxContainer.addEventListener('click', function() {
        appCheckbox.checked = !appCheckbox.checked;

        if (appCheckbox.checked) {
          appSvg.innerHTML = `<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M4.82498 4L7.32923 1.49575C7.55731 1.26767 7.55731 0.899001 7.32923 0.670918C7.10115 0.442834 6.73248 0.442834 6.5044 0.670918L4.00015 3.17517L1.4959 0.670918C1.26781 0.442834 0.899146 0.442834 0.671063 0.670918C0.442979 0.899001 0.442979 1.26767 0.671063 1.49575L3.17531 4L0.671063 6.50425C0.442979 6.73233 0.442979 7.101 0.671063 7.32908C0.784813 7.44283 0.934146 7.5 1.08348 7.5C1.23281 7.5 1.38215 7.44283 1.4959 7.32908L4.00015 4.82483L6.5044 7.32908C6.61815 7.44283 6.76748 7.5 6.91681 7.5C7.06615 7.5 7.21548 7.44283 7.32923 7.32908C7.55731 7.101 7.55731 6.73233 7.32923 6.50425L4.82498 4Z" fill="white"/>
          </svg>`
          checkboxContainer.classList.add('select-checkbox');
          checkboxContainer.querySelector('label').classList.add('select-checkbox-label');
        } else {
          appSvg.innerHTML = `<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2486 5.40155H11.2504C11.5718 5.40155 11.8331 5.66172 11.8337 5.98313C11.8384 7.54122 11.2358 9.0083 10.1368 10.1131C9.03835 11.218 7.57535 11.8287 6.01727 11.8334H6.00035C4.4481 11.8334 2.98802 11.2314 1.88727 10.1365C0.782436 9.03805 0.171686 7.57505 0.167019 6.01697C0.162352 4.4583 0.764936 2.9918 1.86394 1.88697C2.96235 0.782134 4.42535 0.171384 5.98344 0.166718C6.44719 0.173718 6.91969 0.220384 7.37235 0.328884C7.68502 0.404718 7.8781 0.719718 7.80227 1.03297C7.72702 1.34563 7.41027 1.53813 7.09877 1.46347C6.73652 1.37597 6.3521 1.33922 5.98694 1.33338C4.74035 1.33688 3.5696 1.82572 2.6911 2.70947C1.81202 3.59322 1.33019 4.76688 1.33369 6.01347C1.33719 7.26005 1.82602 8.43022 2.70977 9.3093C3.5906 10.1849 4.75844 10.6667 6.00035 10.6667H6.01377C7.26035 10.6632 8.4311 10.1744 9.3096 9.29064C10.1887 8.4063 10.6705 7.23322 10.667 5.98663C10.6664 5.66464 10.9266 5.40213 11.2486 5.40155ZM3.83793 5.58759C4.06602 5.35951 4.43468 5.35951 4.66277 5.58759L5.97177 6.89659L9.64502 2.69892C9.85735 2.45801 10.2254 2.43234 10.4681 2.64467C10.7102 2.85642 10.7347 3.22509 10.5223 3.46776L6.43902 8.13442C6.33285 8.25576 6.18118 8.32751 6.0196 8.33334H6.00035C5.84577 8.33334 5.6976 8.27209 5.58793 8.16242L3.83793 6.41242C3.60985 6.18434 3.60985 5.81567 3.83793 5.58759Z" fill="#A2A2A2"/>
          </svg>`
          checkboxContainer.classList.remove('select-checkbox');
          checkboxContainer.querySelector('label').classList.remove('select-checkbox-label');
        }

      });

      checkboxContainer.addEventListener('click', function(event) {
        event.stopPropagation();
      });
    });


    btnOpenListFromCityes.addEventListener('click', () => {
      searchCityFromInput.classList.toggle('application-input-focus');
      if (!isListCityesFromVisible) {
        disclosedListCityesFrom.style.display = 'none';
        isListCityesFromVisible = true;
      } else {
        disclosedListCityesFrom.style.display = 'block';
        isListCityesFromVisible = false;
      }
    })

    btnOpenListToCityes.addEventListener('click', () => {
      searchCityToInput.classList.toggle('application-input-focus');
      if (!isListCityesToVisible) {
        disclosedListCityesTo.style.display = 'none';
        isListCityesToVisible = true;
      } else {
        disclosedListCityesTo.style.display = 'block';
        isListCityesToVisible = false;
      }
    })

    applicationToggle.addEventListener("click", ()=>{
      if (!isShortFormVisible) {
        shortForm.style.display = 'block';
        longForm.style.display = 'none';
        btnReset.style.display = 'none';
        longFormTitle.style.display = 'none';
        isShortFormVisible = true;
        searchForm.classList.toggle('application_search-long-type');
        buttonsContainer.classList.toggle('buttons-for-long-form');
        formHeaderContainer.classList.toggle('header-for-long-form');
      } else {
        shortForm.style.display = 'none';
        longForm.style.display = 'block';
        btnReset.style.display = 'flex';
        longFormTitle.style.display = 'block';
        isShortFormVisible = false;
        searchForm.classList.toggle('application_search-long-type');
        buttonsContainer.classList.toggle('buttons-for-long-form');
        formHeaderContainer.classList.toggle('header-for-long-form');
      }
    });

  }

});
