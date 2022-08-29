import Swiper, { Pagination } from 'swiper';
import HvrSlider from '../plugins/hvr-slider';

window.addEventListener('load', () => {

  Swiper.use([Pagination])

  if (!document.querySelector('.popular__slider')) {
    return false
  } else {

    // card slider
    const popularSlider = new Swiper('.popular__slider.swiper',  {
      breakpoints: {
        320: {
          slidesPerView: 1.1,
          spaceBetween: 15
        },
        768: {
          slidesPerView: 2.5,
          spaceBetween: 30
        },
        1280: {
          slidesPerView: 3,
          spaceBetween: 95,
        }
      }
    });

    // image switcher(Hvr Slider)
    new HvrSlider('.popular__item-gallery');
  }

});
