import anime from 'animejs';

window.addEventListener('load', () => {

  if (!document.querySelector('.contacts')) {
    return false;
  } else {

    // switch content
    const switchItems = document.querySelectorAll('.contacts__switch-content-item');
    const mapButtons = document.querySelectorAll('.contacts__map-btn');

    const switchContent = (event) => {
      const target = event.currentTarget;
      const eventId = target.dataset.id;
      const nextActiveContent = switchItems[eventId];

      mapButtons.forEach(el => el.classList.remove('active'));
      target.classList.add('active');
      switchItems.forEach(el => el.dataset.id === eventId ? el.classList.add('active') : el.classList.remove('active'));

      anime({
        targets: nextActiveContent,
        opacity: [0, 1],
        translateX: [-200, 0],
        duration: 800,
        easing: 'easeOutQuart'
      });

    }

    mapButtons.forEach(el => el.addEventListener('click', switchContent));

  }
});
