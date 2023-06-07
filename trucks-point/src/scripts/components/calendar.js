import VanillaCalendar from '@uvarov.frontend/vanilla-calendar';
import '../../styles/base/calendar/vanilla-calendar.css';
import '../../styles/base/calendar/themes/light.css';
import '../../styles/base/calendar/themes/dark.css';

const options = {
  input: true,
  settings: {
    lang: 'ru',
  },
  selection: {
    time: 24,
    stepMinutes: 15,
  },
  actions: {
    changeToInput(e, HTMLInputElement, dates, time, hours, minutes, keeping) {
      if (dates[0]) {
        HTMLInputElement.value = dates[0];
        // if you want to hide the calendar after picking a date
        calendar.HTMLElement.classList.add('vanilla-calendar_hidden');
      } else {
        HTMLInputElement.value = '';
      }
    },
  },
};
