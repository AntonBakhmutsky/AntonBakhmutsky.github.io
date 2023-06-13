import VanillaCalendar from '@uvarov.frontend/vanilla-calendar';
import '../../styles/base/calendar/vanilla-calendar.css';
import '../../styles/base/calendar/themes/light.css';
import '../../styles/base/calendar/themes/dark.css';
window.addEventListener('load', () => {
  if (!document.querySelector('.counterparty-points')) {
    return null
  } else {

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
            calendar9.HTMLElement.classList.add('vanilla-calendar_hidden');
            calendar10.HTMLElement.classList.add('vanilla-calendar_hidden');
            calendar11.HTMLElement.classList.add('vanilla-calendar_hidden');
          } else {
            HTMLInputElement.value = '';
          }
        },
      },
    };

    const calendar13 = new VanillaCalendar('#calendar-input13', options);
    calendar13.init();

  }
});
