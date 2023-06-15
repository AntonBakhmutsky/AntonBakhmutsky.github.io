import VanillaCalendar from '@uvarov.frontend/vanilla-calendar';
import '../../styles/base/calendar/vanilla-calendar.css';
import '../../styles/base/calendar/themes/light.css';
import '../../styles/base/calendar/themes/dark.css';

window.addEventListener('load', () => {
  if (!document.querySelector('.calendar')) {
    return null
  } else {

    document.addEventListener('click', function(event) {
      const calendars = document.querySelectorAll('.vanilla-calendar');

      calendars.forEach(calendar => {
        if (!calendar.contains(event.target) && calendar.classList.contains('flex')) {
          calendar.HTMLElement.classList.add('vanilla-calendar_hidden');
        }
      });
    });

  }
});
