import inViewport from '@/scripts/plugins/inViewport';
import anime from 'animejs';

window.addEventListener('load', () => {

  if (!document.querySelector('.popular__slider')) {
    return false;
  } else {

    // slides animation
    const partnersSlides = document.querySelectorAll('.partners__slider .swiper-slide');

    partnersSlides.forEach((slide, i )=> {
      inViewport(slide, () => {
        anime({
          targets: slide,
          opacity: [0, 1],
          translateY: [100, 0],
          duration: 1000,
          delay: i * 150,
          easing: 'easeOutQuart'
        })
      });
    });
  }
});
