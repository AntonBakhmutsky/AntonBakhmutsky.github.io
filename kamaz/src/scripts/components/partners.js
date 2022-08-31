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

    // nums animation
    const nums = document.querySelectorAll('.partners__desc-num span');

    nums.forEach((num, i)=> {
      inViewport(num, () => {
        switch (i) {
          case 0:
            anime({
              targets: num,
              innerHTML: [0, 12],
              easing: 'linear',
              round: 1
            });
            break;
          case 1:
            anime({
              targets: num,
              innerHTML: [0, 3594],
              easing: 'linear',
              round: 1
            });
            break;
          case 2:
            anime({
              targets: num,
              innerHTML: [0, 30],
              easing: 'linear',
              round: 1
            });
            break;
        }
      });
    });
  }
});
