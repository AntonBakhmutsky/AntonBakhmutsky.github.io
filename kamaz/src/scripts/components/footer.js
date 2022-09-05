import inViewport from '@/scripts/plugins/inViewport';
import anime from 'animejs';

window.addEventListener('load', () => {

  if (!document.querySelector('.footer')) {
    return false;
  } else {

    // menu animation
    const menuItems = document.querySelectorAll('.footer__menu a');

    menuItems.forEach((slide, i )=> {
      inViewport(slide, () => {
        anime({
          targets: slide,
          opacity: [0, 1],
          translateY: [100, 0],
          duration: 1000,
          delay: i * 150,
          easing: 'easeOutQuart'
        });
      });
    });

    // footer list animations
    const footerListItems = document.querySelectorAll('.footer__list-item');

    footerListItems.forEach((el, i )=> {
      inViewport(el, () => {
        if (i < 4) {
          anime({
            targets: el,
            opacity: [0, 1],
            translateX: [-150, 0],
            duration: 1000,
            delay: i * 100,
            easing: 'easeOutQuart'
          });
        } else {
          anime({
            targets: el,
            opacity: [0, 1],
            translateX: [-150, 0],
            duration: 1000,
            delay: (i - 4) * 100,
            easing: 'easeOutQuart'
          });
        }
      });
    });

    // footer contacts block animations
    const footerContactsItems= document.querySelectorAll('.footer__contacts-block');

    footerContactsItems.forEach(el => {
      inViewport(el, () => {
        anime({
          targets: el,
          opacity: [0, 1],
          translateY: [130, 0],
          duration: 1000,
          easing: 'easeOutQuart'
        });
      });
    });
  }
});
