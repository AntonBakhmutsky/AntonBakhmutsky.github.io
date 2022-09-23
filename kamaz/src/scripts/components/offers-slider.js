import Swiper, { Navigation } from 'swiper';

window.addEventListener('load', () => {

  Swiper.use([Navigation])

  if (!document.querySelector('.offers__slider')) {
    return false;
  } else {

    // card slider
    const popularSlider = new Swiper('.offers__slider.swiper',  {
      navigation: {
        nextEl: '.offers .swiper-button-next',
        prevEl: '.offers .swiper-button-prev'
      }
    });
  }
});
