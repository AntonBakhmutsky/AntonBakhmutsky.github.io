import inViewport from '@/scripts/plugins/inViewport';
import anime from 'animejs';

window.addEventListener('load', () => {

  if (!document.querySelector('.cabin')) {
    return false;
  } else {

    // items animation
    const cabinItems = document.querySelectorAll('.cabin__item');

    cabinItems.forEach((el, i )=> {
      inViewport(el, () => {
        if (window.innerWidth > 1024) {
          if (i < 3) {
            anime({
              targets: el,
              opacity: [.6, 1],
              translateY: [150, 0],
              duration: 1000,
              delay: i * 150,
              easing: 'easeOutQuart'
            });
          }
          if (i > 3 && i < 6) {
            anime({
              targets: el,
              opacity: [.6, 1],
              translateY: [150, 0],
              duration: 1000,
              delay: (i - 3) * 150,
              easing: 'easeOutQuart'
            });
          }
          if (i > 5) {
            console.log(true)
            anime({
              targets: el,
              opacity: [.6, 1],
              translateY: [150, 0],
              duration: 1000,
              delay: (i - 6) * 150,
              easing: 'easeOutQuart'
            });
          }
        } else {
          anime({
            targets: el,
            opacity: [0, 1],
            translateY: [150, 0],
            duration: 1000,
            easing: 'easeOutQuart'
          })
        }
      });
    });
  }
});
