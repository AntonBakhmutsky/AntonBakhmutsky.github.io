window.addEventListener('load', () => {


  if (!document.querySelector('.contacts')) {
    return false;
  } else {

    // switch content
    const contactsItems = document.querySelectorAll('.contacts__item');
    const map = document.querySelectorAll('.contacts__map');
    const mapButtons = document.querySelectorAll('.contacts__map-btn');

    const switchContent = (event) => {
      const target = event.currentTarget;
      const eventId = target.dataset.id;

      mapButtons.forEach(el => el.classList.remove('active'));
      target.classList.add('active');
      contactsItems.forEach(el => el.dataset.id === eventId ? el.classList.add('active') : el.classList.remove('active'));

      window.scrollTo(0, 0);
    }

    mapButtons.forEach(el => el.addEventListener('click', switchContent));

  }
});
