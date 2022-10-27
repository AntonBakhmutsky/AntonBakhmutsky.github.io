import inViewport from '@/scripts/plugins/inViewport';
import anime from 'animejs';

window.addEventListener('load', () => {

  // slide to right
  const slideToRightElements = document.querySelectorAll('.slide-right');

  slideToRightElements.forEach(el => {
    inViewport(el, () => {
      anime({
        targets: el,
        opacity: [0, 1],
        translateX: [-110, 0],
        duration: 1000,
        easing: 'easeOutQuart',
        delay: Number(el.dataset.delay) || 0
      })
    });
  });

  // slide to up
  const slideToUpElements = document.querySelectorAll('.slide-up');

  slideToUpElements.forEach(el => {
    inViewport(el, () => {
      anime({
        targets: el,
        opacity: [0, 1],
        translateY: [130, 0],
        duration: 1000,
        easing: 'easeOutQuart',
        delay: Number(el.dataset.delay) || 0
      })
    });
  });

});
