import Swiper, { Pagination, Navigation } from 'swiper';
import HvrSlider from '../plugins/hvr-slider';
import inViewport from '@/scripts/plugins/inViewport';
import anime from 'animejs';

window.addEventListener('load', () => {

  Swiper.use([Pagination, Navigation])

  if (!document.querySelector('.popular__slider')) {
    return false;
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
          spaceBetween: 95
        }
      },
      navigation: {
        nextEl: '.popular .swiper-button-next',
        prevEl: '.popular .swiper-button-prev'
      }
    });

    // image switcher(Hvr Slider)
    new HvrSlider('.popular__item-gallery');

    // slides animation
    const popularSlides = document.querySelectorAll('.popular__item');

    popularSlides.forEach((slide, i )=> {
      inViewport(slide, () => {
        anime({
          targets: slide,
          opacity: [0, 1],
          translateY: [100, 0],
          duration: 1000,
          delay: (i + 1) * 200,
          easing: 'easeOutQuart'
        })
      });
    });
  }
});
