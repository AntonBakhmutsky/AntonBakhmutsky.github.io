import inViewport from '@/scripts/plugins/inViewport';
import anime from 'animejs';

window.addEventListener('load', () => {

  if (!document.querySelector('.services')) {
    return false;
  } else {

    // items animation
    const servicesItems = document.querySelectorAll('.services__item');

    servicesItems.forEach((el, i )=> {
      inViewport(el, () => {
        if (i < 3) {
          anime({
            targets: el,
            opacity: [.6, 1],
            translateY: [150, 0],
            duration: 1000,
            delay: i * 150,
            easing: 'easeOutQuart'
          })
        } else {
          anime({
            targets: el,
            opacity: [.6, 1],
            translateY: [150, 0],
            duration: 1000,
            delay: (i - 3) * 150,
            easing: 'easeOutQuart'
          })
        }
      });
    });
  }
});
