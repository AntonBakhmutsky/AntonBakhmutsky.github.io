import Swiper, { Navigation } from 'swiper';
import HvrSlider from '../plugins/hvr-slider';

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

    // image switcher(Hvr Slider)
    new HvrSlider('.offers__item-gallery');
  }

});
