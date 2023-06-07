import VanillaCalendar from '@uvarov.frontend/vanilla-calendar';
import '../../styles/base/calendar/vanilla-calendar.css';
import '../../styles/base/calendar/themes/light.css';
import '../../styles/base/calendar/themes/dark.css';
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


    const options = {
      input: true,
      settings: {
        lang: 'ru',
      },
      actions: {
        changeToInput(e, HTMLInputElement, dates) {
          if (dates[0] ) {
            HTMLInputElement.value = dates[0];
            // if you want to hide the calendar after picking a date
            calendar5.HTMLElement.classList.add('vanilla-calendar_hidden');
            calendar6.HTMLElement.classList.add('vanilla-calendar_hidden');
            calendar7.HTMLElement.classList.add('vanilla-calendar_hidden');
            calendar8.HTMLElement.classList.add('vanilla-calendar_hidden');
          } else {
            HTMLInputElement.value = '';
          }
        },
      },
    };

    const calendar5 = new VanillaCalendar('#calendar-input5', options);
    calendar5.init();
    const calendar6 = new VanillaCalendar('#calendar-input6', options);
    calendar6.init();
    const calendar7 = new VanillaCalendar('#calendar-input7', options);
    calendar7.init();
    const calendar8 = new VanillaCalendar('#calendar-input8', options);
    calendar8.init();



  }

});
